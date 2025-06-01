<?php

use App\Http\Controllers\Frontend\ProdukController;
use Illuminate\Support\Facades\Route;

Route::controller(ProdukController::class)->group(function () {
    Route::get('/produk', 'index')->name('produk.index');
    Route::get('/produk/{slug}', 'detail')->name('produk.detail');
});
