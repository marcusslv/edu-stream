<?php

use App\Http\Controllers\VideoManagement\CastMember\CastMemberController;
use App\Http\Controllers\VideoManagement\Category\CategoryController;
use App\Http\Controllers\VideoManagement\Genre\GenreController;
use App\Http\Controllers\VideoManagement\Video\VideoController;
use App\Http\Controllers\SubscriptionManagement\Plan\PlanController;
use Illuminate\Support\Facades\Route;

Route::apiResource('categories', CategoryController::class, [
    'middleware' => ['role:video_administrator', 'auth:sanctum']
]);
Route::apiResource('genres', GenreController::class, [
    'middleware' => ['role:video_administrator', 'auth:sanctum']
]);
Route::apiResource('cast-members', CastMemberController::class, [
    'middleware' => ['auth:sanctum', 'role:video_administrator']
]);

Route::apiResource('videos', VideoController::class, [
    'middleware' => ['role:video_administrator']
]);

Route::post('videos/{video}/upload', [VideoController::class, 'upload'])
    ->middleware('role:video_administrator')
    ->name('videos.upload');

Route::apiResource('plans', PlanController::class, [
    'middleware' => ['role:subscription_administrator']
]);
