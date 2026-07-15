<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::middleware(['guest:web'])->group(function () {

    Route::get('/', [AuthController::class, 'index'])->name('login');
    Route::post('/proseslogin', [AuthController::class, 'proseslogin'])->name('proseslogin');
});

Route::middleware(['auth:web'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/proseslogout', [AuthController::class, 'proseslogout'])->name('proseslogout');
    // Profile
    Route::prefix('profile')->group(function () {
        Route::get('/', [UserController::class, 'profile'])->name('profile');
        Route::post('/update', [UserController::class, 'updateProfile'])->name('profile.update');
        Route::post('/password', [UserController::class, 'updatePassword'])->name('profile.password');
    });

    Route::prefix('user')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('user');
        Route::post('/store', [UserController::class, 'store'])->name('user.store');
        Route::post('/edit', [UserController::class, 'edit'])->name('user.edit');
        Route::post('/{id}', [UserController::class, 'update'])->name('user.update');
        Route::post('/delete/{id}', [UserController::class, 'destroy'])->name('user.delete');
    });
});
