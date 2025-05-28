<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BookingController;
use App\Http\Controllers\Api\ServiceController;

Route::get('/services', [ServiceController::class, 'index']);
Route::post('/book', [BookingController::class, 'store']);
Route::get('/booking/{uuid}', [BookingController::class, 'show']);

Route::prefix('auth')->controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::middleware('jwt')->group(function () {
        Route::get('me', 'me');
        Route::post('logout', 'logout');
    });
});

Route::fallback(function () {
    return (new BaseController)->sendErrorJson('Not Found!');
});
