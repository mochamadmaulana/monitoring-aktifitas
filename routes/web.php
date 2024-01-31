<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/',[AuthController::class,'index'])->name('login');
    Route::post('/',[AuthController::class,'store'])->name('login.store');
});

Route::middleware('auth')->group(function () {
    Route::get('logout',[AuthController::class,'logout'])->name('logout');
});
