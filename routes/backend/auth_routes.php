<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\AuthController as BackendAuthController;

Route::middleware('guest')->group(function () {
    Route::get('auth/login', [BackendAuthController::class, 'login'])->name('auth');
    Route::post('auth/login', [BackendAuthController::class, 'login_process'])->name('auth.process');
});

Route::middleware('auth')->group(function () {
    Route::get('auth/logout', [BackendAuthController::class, 'logout'])->name('auth.logout');
});
