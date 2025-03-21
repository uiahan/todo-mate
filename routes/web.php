<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class, 'index'])->name('index');

Route::prefix('auth')->group(function () {
    Route::controller(AuthController::class)->group(function () {
        Route::post('/login', [AuthController::class, 'login'])->name('login');
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    });
});

Route::middleware('auth')->group(function () {
    Route::group(['prefix' => 'admin', 'middleware' => 'can:admin'], function () {
        Route::controller(AdminController::class)->group(function () {
            Route::get('/dashboard', 'index')->name('admin.dashboard');
        });
    });
});
