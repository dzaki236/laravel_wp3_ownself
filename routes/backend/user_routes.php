<?php

use App\Http\Controllers\Backend\CustomerController;
use App\Http\Controllers\Backend\KategoriController;
use Illuminate\Support\Facades\Route;

Route::middleware(['role:admin,super_admin', 'auth'])->name('customer.')->prefix('customer')->controller(CustomerController::class)->group(function () {
    Route::get('/', 'index')->name('index');
    // Route::get('/create', 'create')->name('create');
    // Route::post('/store', 'store')->name('store');
    Route::get('/edit/{id}', 'edit')->name('edit');
    // Route::put('/update/{id}', 'update')->name('update');
    Route::delete('/destroy/{id}', 'destroy')->name('destroy');
});
