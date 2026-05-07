<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SettingsController;

Route::get('/', function () {
    return redirect('/login');
});

// Pelanggan Routes
Route::get('/katalog', function () {
    return view('pelanggan.katalog');
});

Route::get('/info-toko', function () {
    $settings = \App\Models\StoreSetting::getAllSettings();
    return view('pelanggan.info-toko', compact('settings'));
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

Route::get('/pesanan', [\App\Http\Controllers\OrderController::class, 'myOrders']);
Route::post('/order', [\App\Http\Controllers\OrderController::class, 'store']);

// Auth Routes
Route::get('/login', function () {
    return view('auth.index');
})->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', function () {
    return view('auth.index');
})->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/logout', [AuthController::class, 'logout']); // Fallback

// Admin Routes (Harusnya pakai route group auth & middleware admin, tapi kita sementara buat terbuka atau auth dasar)
Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);
    
    Route::post('/produk', [ProductController::class, 'store']);
    Route::post('/produk/{id}/update', [ProductController::class, 'update']);
    Route::post('/produk/{id}/delete', [ProductController::class, 'destroy']);
    
    Route::post('/stok-masuk', [StockController::class, 'storeIn']);
    Route::post('/stok-keluar', [StockController::class, 'storeOut']);
    
    Route::post('/pesanan/{id}/status', [\App\Http\Controllers\OrderController::class, 'updateStatus']);
    Route::post('/pengaturan', [SettingsController::class, 'update'])->name('admin.settings.update');
});

// UI Integration Routes
Route::get('/produk', [ProductController::class, 'indexUi']);
Route::get('/tambah-produk', [ProductController::class, 'createUi']);
Route::post('/tambah-produk', [ProductController::class, 'storeUi']);
Route::get('/edit-produk/{id}', [ProductController::class, 'editUi']);
Route::post('/update-produk/{id}', [ProductController::class, 'updateUi']);
Route::delete('/hapus-produk/{id}', [ProductController::class, 'destroyUi']);

// Alias for safety
Route::get('/dashboard', function () {
    return redirect('/admin/dashboard');
});
