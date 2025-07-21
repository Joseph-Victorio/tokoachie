<?php

namespace App\Http\Controllers;

use App\Models\Pembeli;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Midtrans\Snap;
use Midtrans\Config;

class PembeliController extends Controller
{
    public function index(Request $request){
        $pembelis = Pembeli::latest()->paginate(5);

        return view('admin.data-pembeli.pembeli-index', compact('pembelis'));
    }
    public function ajaxStore(Request $request)
    {
        $cart = session('cart', []);
        if (empty($cart)) {
            return response()->json(['message' => 'Keranjang kosong.'], 400);
        }

        $validated = $request->validate([
            "nama_pembeli" => 'required',
            "alamat" => 'required',
            "telpon" => 'required',
            "note" => 'nullable',
            "tanggal_pesan" => 'required|date',
            "tanggal_kirim" => 'required|date|after_or_equal:tanggal_pesan',
        ]);

        $produkNames = [];
        $jumlahTotal = 0;
        $total = 0;
        $itemDetails = [];

        foreach ($cart as $item) {
            $nama = $item['nama_produk'] ?? 'Produk';
            $qty = (int) $item['quantity'];
            $harga = (int) $item['harga'];

            $produkNames[] = "$nama x$qty";
            $jumlahTotal += $qty;
            $total += $harga * $qty;

            $itemDetails[] = [
                'id' => $item['id'],
                'price' => $harga,
                'quantity' => $qty,
                'name' => $nama,
            ];
        }

        // Simpan ke database
        Pembeli::create([
            "nama_pembeli" => $validated['nama_pembeli'],
            "alamat" => $validated['alamat'],
            "telpon" => $validated['telpon'],
            "note" => $validated['note'],
            "nama_produk" => implode(', ', $produkNames),
            "jumlah" => $jumlahTotal,
            "total" => $total,
            "tanggal_pesan" => $validated['tanggal_pesan'],
            "tanggal_kirim" => $validated['tanggal_kirim'],
        ]);

        // Midtrans
        \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        \Midtrans\Config::$isProduction = false;
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        $snapToken = \Midtrans\Snap::getSnapToken([
            'transaction_details' => [
                'order_id' => uniqid('ORDER-'),
                'gross_amount' => $total,
            ],
            'customer_details' => [
                'first_name' => $validated['nama_pembeli'],
                'phone' => $validated['telpon'],
            ],
            'item_details' => $itemDetails,
        ]);

        return response()->json(['snap_token' => $snapToken]);
    }

    public function store(Request $request)
    {
        $cart = session('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.show')->with('error', 'Keranjang kosong.');
        }

        $request->validate([
            'nama_pembeli' => 'required|string|max:255',
            'alamat' => 'required|string',
            'telpon' => 'required|string|max:20',
            'note' => 'nullable|string',
            'tanggal_pesan' => 'required|date',
            'tanggal_kirim' => 'required|date|after_or_equal:tanggal_pesan',
        ]);


        $produkNames = [];
        $jumlahTotal = 0;
        $itemDetails = [];
        $total = 0;

        foreach ($cart as $item) {
            $id = $item['id'] ?? uniqid();
            $name = $item['nama_produk'] ?? 'Produk Tanpa Nama';
            $price = (int) str_replace(',', '', $item['harga']);
            $qty = (int) $item['quantity'];

            if (!$name || !$price || !$qty) {
                continue;
            }

            $produkNames[] = "{$name} x{$qty}";
            $jumlahTotal += $qty;
            $total += $price * $qty;

            $itemDetails[] = [
                'id' => $id,
                'price' => $price,
                'quantity' => $qty,
                'name' => $name,
            ];
        }

        if (empty($itemDetails)) {
            return redirect()->route('cart.show')->with('error', 'Item detail tidak valid.');
        }


        Pembeli::create([
            'nama_pembeli' => $request->nama_pembeli,
            'alamat' => $request->alamat,
            'telpon' => $request->telpon,
            'note' => $request->note,
            'nama_produk' => implode(', ', $produkNames),
            'jumlah' => $jumlahTotal,
            'total' => $total,
            'tanggal_pesan' => $request->tanggal_pesan,
            'tanggal_kirim' => $request->tanggal_kirim,
        ]);


        Session::put('pembeli', 'sudah isi');


        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$isProduction = false;
        Config::$isSanitized = true;
        Config::$is3ds = true;

        $snapToken = Snap::getSnapToken([
            'transaction_details' => [
                'order_id' => uniqid('ORDER-'),
                'gross_amount' => $total,
            ],
            'customer_details' => [
                'first_name' => $request->nama_pembeli,
                'phone' => $request->telpon,
            ],
            'item_details' => $itemDetails,
        ]);

        Session::put('snap_token', $snapToken);

        return redirect()->route('cart.show');
    }
}
