<?php

use App\Http\Middleware\ApiKeyMiddleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\CategoryController;
use App\Http\Controllers\Api\V1\BookController;
use App\Http\Controllers\Api\V1\EventController;

Route::middleware([ApiKeyMiddleware::class, 'api'])->group(function () {
    //Books
    Route::get('/v1/books', [BookController::class, 'index']);
    Route::post('/v1/books', [BookController::class, 'store']);
    Route::get('/v1/books/{book}', [BookController::class, 'show']);
    Route::delete('/v1/books/{book}', [BookController::class, 'destroy']);
    Route::put('/v1/books/{book}', [BookController::class, 'update']);

    //Categories
    Route::get('/v1/categories', [CategoryController::class, 'index']);
    Route::post('/v1/categories', [CategoryController::class, 'store']);
    Route::get('/v1/categories/{category}', [CategoryController::class, 'show']);
    Route::delete('/v1/categories/{category}', [CategoryController::class, 'destroy']);
    Route::put('/v1/categories/{category}', [CategoryController::class, 'update']);

    //Events
    Route::get('/v1/events', [EventController::class, 'index']);
    Route::post('/v1/events', [EventController::class, 'store']);
    Route::get('/v1/events/{event}', [EventController::class, 'show']);
    Route::delete('/v1/events/{event}', [EventController::class, 'destroy']);
    Route::put('/v1/events/{event}', [EventController::class, 'update']);
    Route::get('/v1/events/user/{user}', [EventController::class, 'getEventsByUserId']);
    Route::get('/v1/events/book/{book}', [EventController::class, 'getEventsByBookId']);
});
