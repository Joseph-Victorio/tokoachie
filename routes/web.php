<?php

use App\Http\Controllers\ProdukController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReviewPembeliController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('beranda');
})->name('beranda');
Route::get('/tentang-kami', function () {
    return view('client.tentang-kami');
})->name('tentang-kami');
Route::get('/produk', function () {
    return view('client.produk');
})->name('produk');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth', 'verified')->group(function () {
    Route::get('/admin/produk', [ProdukController::class, 'index'])->name('produk.index');
    Route::get('/admin/create-produk', [ProdukController::class, 'create'])->name('produk.create');
    Route::get('/admin/edit-produk', [ProdukController::class,'edit'])->name('produk.edit');
    Route::post('/admin/add-produk', [ProdukController::class, 'store'])->name('produk.store');
    Route::delete('produk-delete/{id}', [ProdukController::class, 'destroy'])->name('produk.destroy');

});
Route::middleware('auth')->group(function () {
    Route::get('/admin/review-pembeli', [ReviewPembeliController::class, 'index'])->name('review.index');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
