<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register.form');
    Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/booking', [MainController::class, 'index'])->name('booking.index');

Route::middleware('auth')->prefix('booking')->name('booking.')->group(function () {
    Route::get('/form', [MainController::class, 'bookingForm'])->name('form');
    // Kita akan mulai membuat flow baru dari sini
});
