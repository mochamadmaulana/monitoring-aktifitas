<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DataMaster\PenggunaController;
use App\Http\Controllers\Admin\DataMaster\RekeningController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/',[AuthController::class,'index'])->name('login');
    Route::post('/',[AuthController::class,'store'])->name('login.store');
});

Route::middleware('auth')->group(function () {
    Route::get('logout',[AuthController::class,'logout'])->name('logout');
});

Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('dashboard',DashboardController::class)->name('dashboard');
    Route::prefix('data-master')->name('data-master.')->group(function () {
        Route::resource('rekening',RekeningController::class);
        Route::resource('pengguna',PenggunaController::class);
    });
    Route::prefix('pemasukan')->name('pemasukan.')->group(function () {
        Route::resource('rekening',App\Http\Controllers\Admin\Pemasukan\RekeningController::class);
        Route::resource('cash',App\Http\Controllers\Admin\Pemasukan\CashController::class);
    });
});
