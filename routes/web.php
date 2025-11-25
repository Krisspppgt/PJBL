<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuestController;

// Guest Routes
Route::get('/', [GuestController::class, 'index'])->name('guest.home');
Route::get('/place/{id}', [GuestController::class, 'show'])->name('guest.place.show');

// Information & Homepage Pages
Route::get('/information', function () {
    return view('page.information');
})->name('information');

Route::get('/homepage', function () {
    return view('page.homepage');
})->name('homepage');

Route::get('/profile', function () {
    return view('profile.edit');
})->name('profile.edit');


require __DIR__.'/auth.php';
