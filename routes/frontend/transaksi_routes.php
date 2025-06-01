<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\OriginController;
use App\Http\Controllers\Frontend\TransaksiController;

Route::middleware(['auth', 'role:customer'])->controller(TransaksiController::class)->group(function () {
    Route::get('transaksi', 'index')->name('transaksi.index');
    Route::post('transaksi', 'store')->name('transaksi.store');
    Route::get('transaksi/show/{transaksi_id}', 'show')->name('transaksi.show');
    Route::get('transaksi/show/{transaksi_id}/pdf', 'generate')->name('transaksi.generate');
});
Route::post('transaksi/notification', [TransaksiController::class, 'notification'])->name('transaksi.notification');
