<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\MainController as FrontendMainController;

Route::get('/', FrontendMainController::class)->name('frontend.index');
