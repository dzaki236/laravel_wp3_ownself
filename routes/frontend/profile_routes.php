<?php

use App\Http\Controllers\Frontend\ProdukController;
use App\Http\Controllers\Frontend\ProfileController as FrontEndProfileController;
use Illuminate\Support\Facades\Route;

Route::middleware(['role:customer', 'auth'])->name('my-profile.')->prefix('my-profile')->controller(FrontEndProfileController::class)->group(function () {
    Route::get('/', 'index')->name('index');
    Route::put('/update', 'update')->name('update');
    Route::post('update_foto_profile', 'update_foto_profile')->name('update_foto_profile');
});
