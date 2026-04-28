<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;

Route::get('/', [PageController::class, 'home'])->name('dashboard');
Route::get('/dashboard', [PageController::class, 'home']);
Route::get('/produk-katalog', [PageController::class, 'list_produk'])->name('katalog');
Route::get('/produk-admin', [PageController::class, 'produk'])->name('admin.produk');
Route::get('/beli', [PageController::class, 'beli']);
Route::get('/history', [PageController::class, 'history']);
Route::get('/help', [PageController::class, 'help']);
Route::post('/produk-simpan', [PageController::class, 'store_produk'])->name('produk.store');
Route::get('/produk-hapus/{id}', [PageController::class, 'hapus_produk'])->name('produk.delete');
Route::view('/tentang', 'tentang');
Route::get('/hitung/{angka1}/{angka2}', function ($a, $b) {
    return "<h1>Hasil penjumlahan $a + $b adalah: " . ($a + $b) . "</h1>";
});