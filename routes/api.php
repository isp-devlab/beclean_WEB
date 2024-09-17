<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\AccountController;
use App\Http\Controllers\Api\GarbageController;
use App\Http\Controllers\Api\MutationController;
use App\Http\Controllers\Api\ProductController;

Route::prefix('/v1')->group(function () {

    Route::prefix('/auth')->group(function () {
        Route::post('/register', [AuthController::class, 'register']);
        Route::post('/login', [AuthController::class, 'login']);
        Route::post('/forget', [AuthController::class, 'forget']);
        Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
    });  

    Route::prefix('/garbage')->middleware('auth:sanctum')->group(function () {
        Route::post('/', [GarbageController::class, 'store']);
        Route::get('/active', [GarbageController::class, 'active']);
        Route::get('/history', [GarbageController::class, 'history']);
    });  

    Route::prefix('/product')->middleware('auth:sanctum')->group(function () {
        Route::get('/', [ProductController::class, 'index']);
    });  

    Route::prefix('/mutation')->middleware('auth:sanctum')->group(function () {
        Route::get('/', [MutationController::class, 'index']);
    }); 

    Route::prefix('/account')->middleware('auth:sanctum')->group(function () {
        Route::get('/', [AccountController::class, 'me']);
        Route::post('/', [AccountController::class, 'update']);
    });  
});