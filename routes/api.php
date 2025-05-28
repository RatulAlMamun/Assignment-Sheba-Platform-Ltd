<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BookingController;
use App\Http\Controllers\Api\ServiceController;

Route::get('/services', [ServiceController::class, 'index']);
Route::post('/book', [BookingController::class, 'store']);
Route::get('/booking/{uuid}', [BookingController::class, 'show']);

Route::middleware('api')->prefix('auth')->group(function () {
    Route::post('login', [AuthController::class, 'login']);
});

Route::fallback(function () {
    return (new BaseController)->sendErrorJson('Not Found!');
});
