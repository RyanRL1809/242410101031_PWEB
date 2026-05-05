<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;

Route::get('/', [PageController::class, 'index'])->name('dashboard');
Route::get('/dashboard', [PageController::class, 'index']);
Route::get('/produk-katalog', [PageController::class, 'list_produk'])->name('katalog');
Route::get('/produk-admin', [PageController::class, 'produk'])->name('admin.produk');
Route::get('/beli', [PageController::class, 'beli']);
Route::get('/history', [PageController::class, 'history']);
Route::get('/help', [PageController::class, 'help']);
Route::get('/about', [PageController::class, 'about']);
Route::get('/contact', [PageController::class, 'contact']);
Route::post('/produk-simpan', [PageController::class, 'store_produk'])->name('produk.store');
Route::get('/produk-hapus/{id}', [PageController::class, 'hapus_produk'])->name('produk.delete');
