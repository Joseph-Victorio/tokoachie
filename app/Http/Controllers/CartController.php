<?php

namespace App\Http\Controllers;

use App\Models\Pembeli;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Midtrans\Snap;
use Midtrans\Config;

class CartController extends Controller
{
    public function checkout(Request $request)
    {
        $cart = session('cart', []);

        if (empty($cart)) {
            return back()->with('error', 'Keranjang belanja kosong!');
        }


        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$isProduction = false;
        Config::$isSanitized = true;
        Config::$is3ds = true;

        $items = [];
        $total = 0;

        foreach ($cart as $item) {
            $items[] = [
                'id' => $item['id'],
                'foto' => $item['foto'],
                'price' => $item['harga'],
                'quantity' => $item['quantity'],
                'name' => $item['nama_produk']
            ];
            $total += $item['harga'] * $item['quantity'];
        }


        $orderId = 'ORDER-' . time();

        $transactionDetails = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => $total,
            ],
            'item_details' => $items,
            'customer_details' => [],
        ];



        $snapToken = Snap::getSnapToken($transactionDetails);

        session()->forget(['cart', 'pembeli']);

        return view('client.checkout', compact('snapToken', 'orderId', 'total', 'items'));
    }
    public function add(Request $request, $id)
    {
        $produk = Produk::findOrFail($id);


        $cart = session('cart', []);

        $quantity = max(1, (int) $request->input('quantity', 1));

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] += $quantity;
        } else {
            $cart[$id] = [
                'id' => $produk->id,
                'nama_produk' => $produk->nama_produk,
                'harga' => $produk->harga,
                'foto' => $produk->foto,
                'quantity' => $quantity,
            ];
        }

        session()->put('cart', $cart);

        return back()->with('success', 'Produk berhasil ditambahkan ke keranjang!');
    }

    public function show()
    {
        $cart = session('cart', []);
        $total = collect($cart)->sum(function ($item) {
            return $item['harga'] * $item['quantity'];
        });

        return view('client.cart', compact('cart', 'total'));
    }
    public function update(Request $request, $id)
    {
        $cart = session('cart', []);

        if (!isset($cart[$id])) {
            return back()->with('error', 'Produk tidak ditemukan di keranjang.');
        }

        $action = $request->input('action');
        $quantity = $cart[$id]['quantity'];

        if ($action === 'increase') {
            $quantity++;
        } elseif ($action === 'decrease' && $quantity > 1) {
            $quantity--;
        }

        $cart[$id]['quantity'] = $quantity;

        session()->put('cart', $cart);

        return back()->with('success', 'Jumlah produk diperbarui.');
    }


    public function remove($id)
    {
        $cart = session('cart', []);
        unset($cart[$id]);
        session()->put('cart', $cart);

        return back()->with('success', 'Produk berhasil dihapus dari keranjang!');
    }

    public function thankYou()
    {
        session()->forget(['cart', 'pembeli', 'snap_token']);

        $order = Pembeli::latest()->first();

        return view('client.thank-you', compact('order'));

        return view('client.thank-you');
    }
}
