<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClientController;
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
    // User
    Route::prefix('user')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('user');
        Route::post('/store', [UserController::class, 'store'])->name('user.store');
        Route::post('/edit', [UserController::class, 'edit'])->name('user.edit');
        Route::post('/{id}', [UserController::class, 'update'])->name('user.update');
        Route::post('/delete/{id}', [UserController::class, 'destroy'])->name('user.delete');
    });

    // Task
    Route::prefix('task')->group(function () {
        Route::get('/', [TaskController::class, 'index'])->name('task');
        Route::get('/create', [TaskController::class, 'create'])->name('task.create');
        Route::post('/store', [TaskController::class, 'store'])->name('task.store');
        Route::get('/show/{id}', [TaskController::class, 'show'])->name('task.show');
        Route::get('/edit/{id}', [TaskController::class, 'edit'])->name('task.edit');
        Route::post('/update/{id}', [TaskController::class, 'update'])->name('task.update');
        Route::post('/update-status/{id}', [TaskController::class, 'updateStatus'])->name('task.update_status');
        Route::post('/delete/{id}', [TaskController::class, 'destroy'])->name('task.delete');
    });

    // Client
    Route::prefix('client')->group(function () {
        Route::get('/', [ClientController::class, 'index'])->name('client');
        Route::post('/store', [ClientController::class, 'store'])->name('client.store');
        Route::post('/update/{id}', [ClientController::class, 'update'])->name('client.update');
        Route::post('/delete/{id}', [ClientController::class, 'destroy'])->name('client.delete');
    });
});
