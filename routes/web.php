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

use App\Http\Controllers\AdminController;

Route::get('/booking', [MainController::class, 'index'])->name('booking.index');

Route::middleware('auth')->prefix('booking')->name('booking.')->group(function () {
    Route::get('/form', [MainController::class, 'bookingForm'])->name('form');
    Route::post('/form', [MainController::class, 'store'])->name('submit');
    Route::get('/payment/{main}', [MainController::class, 'payment'])->name('payment');
    Route::get('/gateway/{main}', [MainController::class, 'gateway'])->name('gateway');
    Route::post('/process/{main}', [MainController::class, 'processPayment'])->name('process');
    Route::get('/proof/{main}', [MainController::class, 'proof'])->name('proof');
    Route::get('/check-status/{main}', [MainController::class, 'checkStatus'])->name('checkStatus');
    Route::delete('/{main}', [MainController::class, 'destroy'])->name('destroy');
});

// Route untuk Dashboard Admin
Route::middleware(\App\Http\Middleware\IsAdmin::class)->group(function () {
    Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/bookings', [AdminController::class, 'bookings'])->name('admin.bookings');
    Route::get('/admin/payments', [AdminController::class, 'payments'])->name('admin.payments');
    Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users');
    Route::delete('/admin/users/{user}', [AdminController::class, 'destroyUser'])->name('admin.destroyUser');
    Route::post('/admin/confirm-payment/{main}', [AdminController::class, 'confirmPayment'])->name('admin.confirmPayment');
    Route::delete('/admin/delete-booking/{main}', [AdminController::class, 'destroyBooking'])->name('admin.destroyBooking');
    
    // Lapangan
    Route::get('/admin/courts', [AdminController::class, 'courts'])->name('admin.courts');
    Route::post('/admin/courts', [AdminController::class, 'storeCourt'])->name('admin.storeCourt');
    Route::put('/admin/courts/{court}', [AdminController::class, 'updateCourt'])->name('admin.updateCourt');
    Route::delete('/admin/courts/{court}', [AdminController::class, 'destroyCourt'])->name('admin.destroyCourt');
});

