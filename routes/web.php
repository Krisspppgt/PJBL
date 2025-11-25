<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\PlaceController;

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

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('places/search', [PlaceController::class, 'search'])->name('places.search');
    Route::get('places/import/{fsq_id}', [PlaceController::class, 'import'])->name('places.import');
    Route::resource('places', PlaceController::class);
});


require __DIR__.'/auth.php';
