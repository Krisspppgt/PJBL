<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuestController;

// Guest Routes
Route::get('/', [GuestController::class, 'index'])->name('guest.home');
Route::get('/place/{id}', [GuestController::class, 'show'])->name('guest.place.show');

// Auth Routes (jika belum ada)
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');
