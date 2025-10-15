<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::withoutMiddleware([\Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class])
    ->group(function () {
        Route::apiResource('products', ProductController::class);
    });
