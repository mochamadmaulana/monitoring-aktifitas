<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DataMaster\BankDompetController;
use App\Http\Controllers\Admin\DataMaster\PenggunaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('dashboard',DashboardController::class)->name('dashboard');
    Route::prefix('data-master')->name('data-master.')->group(function () {
        Route::resource('bank-dompet',BankDompetController::class);
        Route::resource('pengguna',PenggunaController::class);
    });
});
