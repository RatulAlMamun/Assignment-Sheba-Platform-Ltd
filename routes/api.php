<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\Api\BookingController;
use App\Http\Controllers\Api\ServiceController;

Route::get('/services', [ServiceController::class, 'index']);
Route::post('/book', [BookingController::class, 'store']);

Route::fallback(function () {
    return (new BaseController)->sendErrorJson('Not Found!');
});
