<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\ProdukController;
use App\Http\Controllers\Backend\FotoProdukController;

Route::middleware(['role:admin,super_admin', 'auth'])->name('produk.')->prefix('produk')->controller(ProdukController::class)->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/create', 'create')->name('create');
    Route::post('/store', 'store')->name('store');
    Route::get('/edit/{id}', 'edit')->name('edit');
    Route::put('/update/{id}', 'update')->name('update');
    Route::delete('/destroy/{id}', 'destroy')->name('destroy');
    Route::post('update_foto_produk/{id}', [ProdukController::class, 'update_foto_produk'])->name('update_foto_produk');
});
Route::middleware('role:admin,super_admin')->name('foto_produk.')->prefix('foto_produk')->controller(FotoProdukController::class)->group(function () {
    Route::post('/store/{produk_id}', 'store')->name('store');
    Route::delete('/destroy/{id}', 'destroy')->name('destroy');
});
