<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\AccountController;

Route::prefix('/v1')->group(function () {

    Route::prefix('/auth')->group(function () {
        Route::post('/register', [AuthController::class, 'register']);
        Route::post('/login', [AuthController::class, 'login']);
        Route::post('/forget', [AuthController::class, 'forget']);
        Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
    });  

    Route::prefix('/account')->middleware('auth:sanctum')->group(function () {
        Route::get('/', [AccountController::class, 'me']);
        Route::post('/', [AccountController::class, 'update']);
    });  
});