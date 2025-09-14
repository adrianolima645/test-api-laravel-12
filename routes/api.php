<?php

use App\Http\Middleware\ApiKeyMiddleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\BookController;
use App\Http\Controllers\Api\EventController;

Route::middleware([ApiKeyMiddleware::class, 'api'])->group(function () {
    Route::get('/books', [BookController::class, 'index']);
    Route::apiResource('categories', CategoryController::class);
    Route::apiResource('events', EventController::class);
});
