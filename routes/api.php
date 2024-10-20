<?php

use App\Http\Controllers\Api\GifController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:api')->group(function () {
    Route::get('gifs/search', [GifController::class, 'index']);
    Route::post('gifs/favorites', [GifController::class, 'store']);
});