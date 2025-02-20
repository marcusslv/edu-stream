<?php
use App\Http\Controllers\VideoManagement\Category\CategoryController;
use App\Http\Controllers\VideoManagement\Genre\GenreController;
use App\Http\Controllers\CastMember\CastMemberController;
use App\Http\Controllers\VideoManagement\Video\VideoController;
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
