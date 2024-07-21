<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::prefix('/auth')->middleware(['guest'])->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'loginSubmit'])->name('login.submit');
});
Route::get('auth/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');


Route::prefix('/product')->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('product.index');
    Route::post('/', [ProductController::class, 'store'])->name('product.store');
    Route::post('/{id}/update', [ProductController::class, 'update'])->name('product.update');
    Route::get('/{id}/destroy', [ProductController::class, 'destroy'])->name('product.destroy');
    Route::prefix('/category')->group(function () {
        Route::get('/', [ProductCategoryController::class, 'index'])->name('product.category.index');
        Route::post('/', [ProductCategoryController::class, 'store'])->name('product.category.store');
        Route::post('/{id}/update', [ProductCategoryController::class, 'update'])->name('product.category.update');
        Route::get('/{id}/destroy', [ProductCategoryController::class, 'destroy'])->name('product.category.destroy');
    });
})->middleware('auth');

Route::prefix('/user')->group(function () {
    Route::get('/', [UserController::class, 'user'])->name('user');
    Route::post('/', [UserController::class, 'store'])->name('user.store');
    Route::post('/{id}/update', [UserController::class, 'update'])->name('user.update');
    Route::get('/{id}/destroy', [UserController::class, 'destroy'])->name('user.destroy');
})->middleware('auth');