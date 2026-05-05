<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExploreController;

Route::view('/', 'pages.settings.layout')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');

    Route::get('/explore', [ExploreController::class, 'index']) ->name('explore');
});

require __DIR__.'/settings.php';
