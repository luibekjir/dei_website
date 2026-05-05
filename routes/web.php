<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExploreController;

Route::view('/', 'welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');

    Route::get('/explore', [ExploreController::class, 'index']) ->name('explore');

    Route::livewire('/ProfileUser', 'pages::user.profile')->name('profile.user');
});

require __DIR__.'/settings.php';
