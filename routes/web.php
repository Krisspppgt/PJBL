<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\Admin\PlaceController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;


// Guest Routes (untuk yang belum login)
Route::get('/', [GuestController::class, 'index'])->name('guest.home');
Route::get('/place/{id}', [GuestController::class, 'show'])->name('guest.place.show');

// Information & Comment Pages
Route::get('/information', function () {
    return view('page.information');
})->name('information');

Route::get('/comment', function () {
    return view('page.comment');
})->name('comment');

// Admin Routes (hanya untuk admin)
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', function () {
        return redirect()->route('admin.places.index');
    })->name('dashboard');

    Route::get('places/search', [PlaceController::class, 'search'])->name('places.search');
    Route::get('places/import/{fsq_id}', [PlaceController::class, 'import'])->name('places.import');
    Route::resource('places', PlaceController::class);
});

// Authenticated User Routes (untuk yang sudah login)
Route::middleware(['auth'])->group(function () {
    // Homepage
    Route::get('/homepage', [HomeController::class, 'index'])->name('homepage');

    // Favorites Routes
    Route::get('/favorites', [FavoriteController::class, 'index'])->name('favorites.index');
    Route::post('/favorites/toggle/{place}', [FavoriteController::class, 'toggle'])->name('favorites.toggle');
    Route::get('/favorites/check/{place}', [FavoriteController::class, 'check'])->name('favorites.check');

    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Auth Routes (login, register, dll)
require __DIR__.'/auth.php';
