<?php

use App\Http\Controllers\Api\GifController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;


Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::middleware('auth:api')->group(function () {
    Route::get('gifs/search', [GifController::class, 'search'])->name('gifs.search')->middleware('Logger');
    Route::post('gifs/favorites', [GifController::class, 'store'])->name('gifs.favorites')->middleware('Logger');
    Route::get('gifs/{id}', [GifController::class, 'show'])->name('gifs.show')->middleware('Logger');
});