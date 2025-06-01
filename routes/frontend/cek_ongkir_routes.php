<?php

use App\Http\Controllers\Frontend\CekOngkirController;
use Illuminate\Support\Facades\Route;

Route::controller(CekOngkirController::class)->group(function () {
    Route::get('/check_ongkir', 'check_ongkir')->name('check_ongkir');
});
