<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\Api\ServiceController;

Route::get('/services', [ServiceController::class, 'index']);


Route::fallback(function () {
    return (new BaseController)->sendErrorJson('Not Found!');
});
