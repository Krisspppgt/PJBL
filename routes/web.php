<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuestController;

// Guest Routes
Route::get('/', [GuestController::class, 'index'])->name('guest.home');
Route::get('/place/{id}', [GuestController::class, 'show'])->name('guest.place.show');

// Auth Routes (jika belum ada)


Route::get('/information', function () {
    return view('page.information');
})->name('information');

Route::get('/profile', function () {
    return view('profile.edit');
})->name('profile.edit');

Route::post('/logout', function () {
    // Logic untuk logout
})->name('logout');


Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');




