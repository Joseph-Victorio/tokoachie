<?php

namespace App\Http\Controllers;

use App\Models\ReviewPembeli;
use Illuminate\Http\Request;

class ReviewPembeliController extends Controller
{
    public function index(Request $request)
    {
        $reviews = ReviewPembeli::latest()->paginate(5);
        return view('admin.review-pembeli.review-index', compact('reviews'));
    }

    public function create()
    {
        return view('admin.review-pembeli.review-create');
    }

    public function store(Request $request)
    {
        $request->validate([
            "foto" => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            "nama_klien" => 'required',
            "isi_review" => 'required',
        ]);

        $imageName = time() . '.' . $request->foto->extension();
        $uploadPath = public_path('uploads/review-pembeli');

        if (!is_dir($uploadPath)) {
            mkdir($uploadPath, 0755, true);
        }

        $request->foto->move($uploadPath, $imageName);

        ReviewPembeli::create([
            "foto" => 'uploads/review-pembeli/' . $imageName,
            "nama_klien" => $request->nama_klien,
            "isi_review" => $request->isi_review,
        ]);

        return redirect()->route('review.index')->with('success', "Berhasil menambahkan data ReviewPembeli.");
    }

    public function edit($id)
    {
        $review = ReviewPembeli::findOrFail($id);
        return view('admin.review-pembeli.review-edit', compact('review'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            "foto" => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            "nama_klien" => 'required',
            "isi_review" => 'required',
        ]);

        $review = ReviewPembeli::findOrFail($id);

        $data = [
            "nama_klien" => $request->nama_klien,
            "isi_review" => $request->isi_review,
        ];

        if ($request->hasFile('foto')) {
            $oldFile = public_path($review->foto);
            if ($review->foto && is_file($oldFile)) {
                unlink($oldFile);
            }

            $imageName = time() . '.' . $request->foto->extension();
            $uploadPath = public_path('uploads/review-pembeli');

            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }

            $request->foto->move($uploadPath, $imageName);
            $data['foto'] = 'uploads/review-pembeli/' . $imageName;
        } else {
            $data['foto'] = $review->foto;
        }

        $review->update($data);

        return redirect()->route('review.index')->with('success', 'Data berhasil diupdate');
    }

    public function destroy($id)
    {
        $review = ReviewPembeli::findOrFail($id);

        if ($review->foto && is_file(public_path($review->foto))) {
            unlink(public_path($review->foto));
        }

        $review->delete();

        return redirect()->route('review.index')->with('success', 'Data berhasil dihapus');
    }
}
