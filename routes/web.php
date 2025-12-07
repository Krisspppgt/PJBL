<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\Admin\PlaceController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;


// Guest Routes
Route::get('/', [GuestController::class, 'index'])->name('guest.home');
Route::get('/place/{id}', [GuestController::class, 'show'])->name('guest.place.show');

// Information & Homepage Pages
Route::get('/information', function () {
    return view('page.information');
})->name('information');

Route::get('/comment', function () {
    return view('page.comment');
})->name('comment');



Route::get('/profile', function () {
    $user = Auth::user(); 
    return view('profile.edit');
    
})->name('profile.edit');

  // Update profil
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');


Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', function () {
        return redirect()->route('admin.places.index');
    })->name('dashboard');

    Route::get('places/search', [PlaceController::class, 'search'])->name('places.search');
    Route::get('places/import/{fsq_id}', [PlaceController::class, 'import'])->name('places.import');
    Route::resource('places', PlaceController::class);
});

Route::middleware(['auth'])->group(function () {
    Route::get('/homepage', [HomeController::class, 'index'])->name('homepage');
});




require __DIR__.'/auth.php';
