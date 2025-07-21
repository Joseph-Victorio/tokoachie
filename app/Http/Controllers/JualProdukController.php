<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class JualProdukController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $produks = Produk::query()
            ->when($search, function ($query, $search) {
                $query->where('nama_Produk', 'like', "%{$search}%")
                    ->orWhere('jenis_kue', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(5)
            ->appends(['search' => $search]);


        return view('client.produk', compact('produks', 'search'));
    }
    public function detail(Request $request, $id)
    {
        $produk = Produk::find($id);

        return view('client.produk-detail', compact('produk'));
    }
}
