<?php

use App\Http\Controllers\Backend\Laporan\ProdukController;
use Illuminate\Support\Facades\Route;

Route::middleware(['role:super_admin', 'auth'])->prefix('report')->name('report.')->controller(ProdukController::class)->group(function () {
    Route::get('/produk', 'index')->name('produk');
    Route::get('/produk/pdf', 'generate_pdf')->name('produk.pdf');
});
