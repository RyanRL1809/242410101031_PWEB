<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'index'])->name('home');
Route::get('/produk-katalog', [ProductController::class, 'catalog'])->name('katalog');
Route::get('/help', [PageController::class, 'help'])->name('help');
Route::get('/beli', [PageController::class, 'beli'])->name('beli');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [PageController::class, 'index'])->name('dashboard');
    Route::get('/history', [PageController::class, 'history'])->name('history');
    Route::resource('products', ProductController::class)->only([
        'index', 'store', 'edit', 'update', 'destroy',
    ]);
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

});

require __DIR__.'/auth.php';
