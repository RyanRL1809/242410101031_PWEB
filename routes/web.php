<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'index'])->name('home');
Route::get('/produk-katalog', [ProductController::class, 'catalog'])->name('katalog');
Route::get('/help', [PageController::class, 'help'])->name('help');
Route::get('/beli', [PageController::class, 'beliForm'])->name('beli');
Route::post('/beli', [PageController::class, 'storeOrder'])->name('beli.store');
Route::get('/beli/{product}', [PageController::class, 'beli'])->name('beli.show');
Route::get('/beli/qris/{order}', [PageController::class, 'qris'])->name('beli.qris');
Route::post('/beli/qris/{order}/complete', [PageController::class, 'completeOrder'])->name('beli.complete');
Route::get('/beli/qris/{order}/success', [PageController::class, 'qrisSuccess'])->name('beli.qris.success');
Route::post('/katalog/search', [ProductController::class, 'search'])->name('katalog.search');
Route::get('/pengaturan', [PageController::class, 'pengaturan'])->name('pengaturan.index');
Route::post('/pengaturan/simpan', [PageController::class, 'simpanPengaturan'])->name('pengaturan.simpan');
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [PageController::class, 'index'])->name('dashboard');
    Route::get('/history', [PageController::class, 'history'])->name('history');
    // Produk resource sekarang diatur di group ['auth','admin']
    // agar hanya admin yang bisa mengakses halaman manajemen produk.
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

Route::middleware(['auth', 'admin'])->group(function () {

    Route::resource('products', ProductController::class);
    Route::get('/admin/pelanggan', [PageController::class, 'customers'])->name('admin.users.index');
    Route::post('/history/{order}/status', [PageController::class, 'updateOrderStatus'])->name('history.updateStatus');

});

require __DIR__.'/auth.php';
