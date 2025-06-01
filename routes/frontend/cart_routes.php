<?php

use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\ProdukController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth','role:customer'])->controller(CartController::class)->group(function () {
    Route::get('/cart', 'index')->name('cart.index');
    Route::post('/cart/{produk_id}', 'add_to_cart')->name('cart.add_to_cart');
    Route::delete('/cart/{produk_id}', 'delete_item_cart')->name('cart.delete_item_cart');
    Route::put('/cart/update', 'update_cart')->name('cart.update_cart');
});
