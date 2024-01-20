<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DataMaster\BankDompetController;
use App\Http\Controllers\Admin\DataMaster\PenggunaController;
use App\Http\Controllers\Admin\DataMaster\RekeningBankDompetController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('dashboard',DashboardController::class)->name('dashboard');
    Route::prefix('data-master')->name('data-master.')->group(function () {
        Route::resource('bank-dompet',BankDompetController::class);
        Route::resource('rekening-bank-dompet',RekeningBankDompetController::class);
        Route::resource('pengguna',PenggunaController::class);
    });
});
