<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DataMaster\BankDompetController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('dashboard',DashboardController::class)->name('dashboard');
Route::prefix('data-master')->name('data-master.')->group(function () {
    Route::resource('bank-dompet',BankDompetController::class);
});
