<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\AuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware('throttle:10,1')->group(function () {

    // Frontend Routes
    $includeFrontEndFolders = ['frontend'];
    foreach ($includeFrontEndFolders as $folderFrontEnd) {
        foreach (glob(__DIR__ . "/{$folderFrontEnd}/*.php") as $fileFrontEnd) {
            require $fileFrontEnd;
        }
    }

    // Backend Routes
    Route::prefix('backend')->name('backend.')->group(function () {
        $includeBackendFolders = ['backend'];
        foreach ($includeBackendFolders as $folderBackend) {
            foreach (glob(__DIR__ . "/{$folderBackend}/*.php") as $fileBackend) {
                require $fileBackend;
            }
        }
    });

    Route::get('/login', function () {
        return redirect('/');
    })->name('login');
    Route::get('/home', function () {
        return redirect()->route('backend.dashboard.index');
    })->name('home');
});
