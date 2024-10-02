<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('register',[AuthController::class, 'register']);
Route::post('login',[AuthController::class, 'login']);

Route::middleware('auth:api')->group(function () {
    Route::get('users',[UserController::class, 'user']);
    Route::post('logout',[AuthController::class, 'logout']);
});

