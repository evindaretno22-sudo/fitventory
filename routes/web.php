<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return redirect('/login');
});

// Pelanggan Routes
Route::get('/katalog', function () {
    return view('pelanggan.katalog');
});

Route::get('/info-toko', function () {
    return view('pelanggan.info-toko');
});

Route::get('/keranjang', function () {
    return view('pelanggan.keranjang');
});

Route::get('/checkout', function () {
    return view('pelanggan.checkout');
});

Route::get('/pembayaran', function () {
    return view('pelanggan.pembayaran');
});

Route::get('/pesanan', function () {
    return view('pelanggan.pesanan');
});

// Admin Routes
Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
});

// Alias for safety
Route::get('/dashboard', function () {
    return view('admin.dashboard');
});

// Auth Routes
Route::get('/login', function () {
    return view('auth.index');
})->name('login');

Route::get('/register', function () {
    return view('auth.index');
})->name('register');

// Product Routes (Based on existing ProductController)
Route::get('/produk', [ProductController::class, 'index']);
Route::get('/tambah-produk', [ProductController::class, 'create']);
Route::post('/tambah-produk', [ProductController::class, 'store']);
Route::get('/edit-produk/{id}', [ProductController::class, 'edit']);
Route::post('/update-produk/{id}', [ProductController::class, 'update']);
Route::delete('/hapus-produk/{id}', [ProductController::class, 'destroy']);
