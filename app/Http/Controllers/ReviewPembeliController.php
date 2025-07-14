<?php

namespace App\Http\Controllers;

use App\Models\ReviewPembeli;
use Illuminate\Http\Request;

class ReviewPembeliController extends Controller
{
     public function index(Request $request)
    {
        $search = $request->input('search');

        $reviews = ReviewPembeli::query()
            ->when($search, function ($query, $search) {
                $query->where('nama_kategori', 'like', "%{$search}%")
                    ->orWhere('tipe', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(5)
            ->appends(['search' => $search]);

        return view('admin.review-pembeli.review-index', compact('reviews', 'search'));
    }
}
