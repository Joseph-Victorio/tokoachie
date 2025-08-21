<?php

use App\Http\Controllers\BerandaController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\JualProdukController;
use App\Http\Controllers\PembeliController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReviewPembeliController;
use Illuminate\Support\Facades\Route;

Route::get('/', [BerandaController::class, 'index'])->name('beranda');
Route::get('/tentang-kami', function () {
    return view('client.tentang-kami');
})->name('tentang-kami');

Route::get('/produk', [JualProdukController::class, 'index'])->name('produk');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::post('/add-to-cart/{id}', [CartController::class, 'add'])->name('cart.add');
Route::get('/cart', [CartController::class, 'show'])->name('cart.show');
Route::post('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
Route::get('/checkout/success', [CartController::class, 'thankYou'])->name('checkout.success');

Route::get('/produk/{id}', [JualProdukController::class, 'detail'])->name('produk.detail');

Route::post('/pembeli/ajax/store', [PembeliController::class, 'ajaxStore'])->name('pembeli.ajax.store');


Route::post('/pembeli', [PembeliController::class, 'store'])->name('pembeli.data');
Route::middleware('auth', 'verified')->group(function () {
    Route::get('/admin/produk', [ProdukController::class, 'index'])->name('produk.index');
    Route::get('/admin/create-produk', [ProdukController::class, 'create'])->name('produk.create');
    Route::get('/admin/edit-produk/{id}', [ProdukController::class, 'edit'])->name('produk.edit');
    Route::post('/admin/add-produk', [ProdukController::class, 'store'])->name('produk.store');
    Route::put('/admin/update-produk/{id}', [ProdukController::class, 'update'])->name('produk.update');
    Route::delete('/admin/produk-delete/{id}', [ProdukController::class, 'destroy'])->name('produk.destroy');

    Route::get('/admin/review-pembeli', [ReviewPembeliController::class, 'index'])->name('review.index');
    Route::get('/admin/create-review-pembeli', [ReviewPembeliController::class, 'create'])->name('review.create');
    Route::get('/admin/edit-review-pembeli/{id}', [ReviewPembeliController::class, 'edit'])->name('review.edit');
    Route::post('/admin/add-review-pembeli', [ReviewPembeliController::class, 'store'])->name('review.store');
    Route::put('/admin/update-review-pembeli/{id}', [ReviewPembeliController::class, 'update'])->name('review.update');
    Route::delete('/admin/review-pembeli-delete/{id}', [ReviewPembeliController::class, 'destroy'])->name('review.destroy');

     Route::get('/admin/data-pembeli', [PembeliController::class, 'index'])->name('pembeli.index');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



require __DIR__ . '/auth.php';
