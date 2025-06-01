<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\DashboardController;

Route::middleware(['role:admin,super_admin', 'auth'])->group(function () {
    Route::get('dashboard', DashboardController::class)->name('dashboard.index');
});
