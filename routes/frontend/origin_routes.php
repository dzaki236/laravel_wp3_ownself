<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\OriginController;
Route::controller(OriginController::class)->group(function () {
    Route::get('/origin/{province_id}', 'get_cities_origin');
});
