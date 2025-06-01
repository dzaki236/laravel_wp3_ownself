<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\ProfileController as BackEndProfileController;

Route::middleware(['role:admin,super_admin', 'auth'])->name('my-profile.')->prefix('my-profile')->controller(BackEndProfileController::class)->group(function () {
    Route::get('/', 'index')->name('index');
    Route::put('/update', 'update')->name('update');
    Route::post('update_foto_profile', 'update_foto_profile')->name('update_foto_profile');
});
