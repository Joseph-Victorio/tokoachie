<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index(Request $request)
    {
        dd(public_path('uploads/produk'));

        $search = $request->input('search');

        $produks = Produk::query()
            ->when($search, function ($query, $search) {
                $query->where('nama_produk', 'like', "%{$search}%")
                      ->orWhere('jenis_kue', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(5)
            ->appends(['search' => $search]);

        return view('admin.produk.produk-index', compact('produks', 'search'));
    }

    public function create()
    {
        return view('admin.produk.produk-create');
    }

    public function store(Request $request)
    {
        $request->validate([
            "foto" => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            "nama_produk" => 'required',
            "deskripsi" => 'required',
            "harga" => 'required|numeric',
            "jenis_kue" => 'required',
            "status" => 'required',
        ]);

        $imageName = time() . '.' . $request->foto->extension();
        $uploadPath = public_path('uploads/produk');

        if (!is_dir($uploadPath)) {
            mkdir($uploadPath, 0755, true);
        }

        $request->foto->move($uploadPath, $imageName);

        Produk::create([
            "foto" => 'uploads/produk/' . $imageName,
            "nama_produk" => $request->nama_produk,
            "deskripsi" => $request->deskripsi,
            "harga" => $request->harga,
            "jenis_kue" => $request->jenis_kue,
            "status" => $request->status,
        ]);

        return redirect()->route('produk.index')->with('success', "Berhasil menambahkan data produk.");
    }

    public function edit($id)
    {
        $produk = Produk::findOrFail($id);
        return view('admin.produk.produk-edit', compact('produk'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            "foto" => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            "nama_produk" => 'required',
            "deskripsi" => 'required',
            "harga" => 'required|numeric',
            "jenis_kue" => 'required',
            "status" => 'required',
        ]);

        $produk = Produk::findOrFail($id);

        $data = [
            "nama_produk" => $request->nama_produk,
            "deskripsi" => $request->deskripsi,
            "harga" => $request->harga,
            "jenis_kue" => $request->jenis_kue,
            "status" => $request->status,
        ];

        if ($request->hasFile('foto')) {
            if ($produk->foto) {
                $oldFile = public_path($produk->foto);
                if (is_file($oldFile)) {
                    unlink($oldFile);
                }
            }

            $imageName = time() . '.' . $request->foto->extension();
            $uploadPath = public_path('uploads/produk');

            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }

            $request->foto->move($uploadPath, $imageName);
            $data['foto'] = 'uploads/produk/' . $imageName;
        } else {
            $data['foto'] = $produk->foto;
        }

        $produk->update($data);

        return redirect()->route('produk.index')->with('success', 'Data berhasil diupdate');
    }

    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);

        if ($produk->foto) {
            $oldFile = public_path($produk->foto);
            if (is_file($oldFile)) {
                unlink($oldFile);
            }
        }

        $produk->delete();

        return redirect()->route('produk.index')->with('success', 'Data berhasil dihapus');
    }
}
