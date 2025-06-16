<?php

use App\Http\Controllers\Backend\CustomerController;
use Illuminate\Support\Facades\Route;

Route::prefix('user-management')->group(function () {
    Route::middleware(['role:admin,super_admin', 'auth'])->name('customer.')->prefix('customer')->controller(CustomerController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::delete('/destroy/{id}', 'destroy')->name('destroy');
    });
});
