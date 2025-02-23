<?php

use App\Http\Controllers\User\AuthController;
use App\Http\Controllers\VideoCatalog\Catalog\CatalogController;
use Illuminate\Support\Facades\Route;


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);
});

Route::apiResource('catalogs', CatalogController::class);
