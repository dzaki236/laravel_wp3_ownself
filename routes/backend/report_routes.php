<?php

use App\Http\Controllers\Backend\Laporan\ProdukController as LaporanProdukController;
use App\Http\Controllers\Backend\Laporan\TransaksiController as LaporanTransaksiController;
use Illuminate\Support\Facades\Route;

Route::middleware(['role:super_admin', 'auth'])->prefix('report')->name('report.')->controller(LaporanProdukController::class)->group(function () {
    Route::get('/produk', 'index')->name('produk');
    Route::get('/produk/generate', 'generate')->name('produk.generate');
});
Route::middleware(['role:super_admin', 'auth'])->prefix('report')->name('report.')->controller(LaporanTransaksiController::class)->group(function () {
    Route::get('/transaksi', 'index')->name('transaksi');
    Route::get('/transaksi/generate', 'generate')->name('transaksi.generate');
});
