<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\AuthController as FrontendAuthController;

Route::middleware('guest')->group(function () {
    Route::get('auth/login/redirect', [FrontendAuthController::class, 'redirect'])->name('auth.redirect');
    Route::get('auth/google/callback', [FrontendAuthController::class, 'callback'])->name('auth.callback');
});

Route::middleware('auth')->group(function () {
    Route::get('auth/logout', [FrontendAuthController::class, 'logout'])->name('auth.logout');
});
