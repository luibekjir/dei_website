<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExploreController;

Route::view('/', 'layout')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
    Route::get('/restaurant/{restaurant}', [ExploreController::class, 'show'])->name('restaurant.show');
    Route::livewire('order', 'order-component')->name('order');

  
    Route::get('/explore', [ExploreController::class, 'index']) ->name('explore');
    Route::get('/random', [ExploreController::class, 'random'])->name('explore.random');

    Route::livewire('/profile', 'pages::user.profile')->name('profile.user');
});

require __DIR__.'/settings.php';
