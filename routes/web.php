<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BaseController;

Route::get('/', function () {
    return (new BaseController)->sendSuccessJson(
        ['timestamp' => now(),],
        'Sheba api running...',
    );
});

Route::fallback(function () {
    return (new BaseController)->sendErrorJson('Not Found!');
});
