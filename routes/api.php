<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PlaceController;
use Illuminate\Support\Facades\Route;

// public routes
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::resource('/places', PlaceController::class);
});
