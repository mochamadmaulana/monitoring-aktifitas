<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DataMaster\BankDompetController;
use App\Http\Controllers\Admin\DataMaster\PenggunaController;
use App\Http\Controllers\Admin\DataMaster\RekeningBankDompetController;
use App\Http\Controllers\Admin\PemasukanController;
use App\Http\Controllers\Admin\PengeluaranController;
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
        Route::resource('bank-dompet',BankDompetController::class);
        Route::resource('rekening-bank-dompet',RekeningBankDompetController::class);
        Route::resource('pengguna',PenggunaController::class);
    });
    Route::resource('pemasukan',PemasukanController::class);
    Route::resource('pengeluaran',PengeluaranController::class);
});
