<?php

use App\Http\Controllers\Frontend\AlamatController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'role:customer'])->controller(AlamatController::class)->group(function () {
    Route::get('alamat', 'index')->name('alamat.index');
    Route::get('alamat/new', 'create')->name('alamat.create');
    Route::post('alamat', 'store')->name('alamat.store');
    Route::get('alamat/edit/{id}', 'edit')->name('alamat.edit');
    Route::put('alamat/{id}', 'update')->name('alamat.update');
    Route::delete('alamat/{id}', 'destroy')->name('alamat.destroy');
});
