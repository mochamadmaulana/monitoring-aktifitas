<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DataMaster\BankDompetController;
use App\Http\Controllers\Admin\DataMaster\PenggunaController;
use App\Http\Controllers\Admin\DataMaster\RekeningController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('dashboard',DashboardController::class)->name('dashboard');
    Route::prefix('data-master')->name('data-master.')->group(function () {
        Route::resource('bank-dompet',BankDompetController::class);
        Route::resource('rekening',RekeningController::class);
        Route::resource('pengguna',PenggunaController::class);
    });
    Route::prefix('pemasukan')->name('pemasukan.')->group(function () {
        Route::resource('rekening',App\Http\Controllers\Admin\Pemasukan\RekeningController::class);
        Route::resource('cash',App\Http\Controllers\Admin\Pemasukan\CashController::class);
    });
});
