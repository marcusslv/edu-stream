<?php

use App\Http\Controllers\User\AuthController;
use App\Http\Controllers\VideoCatalog\Catalog\CatalogController;
use App\Http\Controllers\SubscriptionManagement\Subscription\SubscriptionController;
use App\Http\Controllers\VideoCatalog\Catalog\WatchVideoController;
use Illuminate\Support\Facades\Route;


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);
    Route::apiResource('catalogs', CatalogController::class);
    Route::apiResource('subscriptions', SubscriptionController::class);
    Route::get('/watch/{video}', [WatchVideoController::class, 'show']);
});

