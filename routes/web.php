<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\TransactionOnProgressController;
use App\Http\Controllers\TransactionPendingController;
use App\Http\Controllers\TransactionPickupController;
use App\Models\Transaction;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::prefix('/auth')->middleware(['guest'])->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'loginSubmit'])->name('login.submit');
    Route::get('/forget', [AuthController::class, 'forget'])->name('forget');
    Route::post('/forget', [AuthController::class, 'forgetSubmit'])->name('forget.submit');
    Route::get('/forget/{token}/reset', [AuthController::class, 'reset'])->name('reset');
    Route::post('/forget/{token}/reset', [AuthController::class, 'resetSubmit'])->name('reset.submit');
});
Route::get('auth/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('pickup/{id}', [DashboardController::class, 'pickup'])->name('dashboard.pickup');
Route::get('pickup/{id}/selesai', [DashboardController::class, 'selesai'])->name('dashboard.pickup.selesai');
Route::post('pickup/{id}/selesai', [DashboardController::class, 'selesai'])->name('dashboard.pickup.selesai.post');
Route::post('pickup-add', [DashboardController::class, 'pickupAdd'])->name('dashboard.pickup.add');

Route::prefix('/transaction')->group(function () {
    Route::prefix('/pending')->group(function () {
        Route::get('/', [TransactionPendingController::class, 'index'])->name('transaction.pending.index');
        Route::post('/{id}/add-schedule', [TransactionPendingController::class, 'addSchedule'])->name('transaction.pending.addSchedule');
    });
    Route::prefix('/on-progress')->group(function () {
        Route::get('/', [TransactionOnProgressController::class, 'index'])->name('transaction.onprogress.index');
    });
    Route::prefix('/pickup')->group(function () {
        Route::get('/', [TransactionPickupController::class, 'index'])->name('transaction.pickup.index');
    });
})->middleware('auth');

Route::prefix('/product')->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('product.index');
    Route::post('/', [ProductController::class, 'store'])->name('product.store');
    Route::post('/{id}/update', [ProductController::class, 'update'])->name('product.update');
    Route::get('/{id}/destroy', [ProductController::class, 'destroy'])->name('product.destroy');
    // Route::prefix('/category')->group(function () {
    //     Route::get('/', [ProductCategoryController::class, 'index'])->name('product.category.index');
    //     Route::post('/', [ProductCategoryController::class, 'store'])->name('product.category.store');
    //     Route::post('/{id}/update', [ProductCategoryController::class, 'update'])->name('product.category.update');
    //     Route::get('/{id}/destroy', [ProductCategoryController::class, 'destroy'])->name('product.category.destroy');
    // });
})->middleware('auth');

Route::prefix('/user')->group(function () {
    Route::get('/', [UserController::class, 'user'])->name('user');
    Route::post('/', [UserController::class, 'store'])->name('user.store');
    Route::post('/{id}/update', [UserController::class, 'update'])->name('user.update');
    Route::get('/{id}/destroy', [UserController::class, 'destroy'])->name('user.destroy');
})->middleware('auth');