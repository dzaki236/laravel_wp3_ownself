<?php

use App\Http\Controllers\Backend\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('user-management')->group(function () {
    Route::middleware(['role:admin,super_admin', 'auth'])->name('user.')->prefix('user')->controller(UserController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::delete('/destroy/{id}', 'destroy')->name('destroy');
    });
});
