<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExploreController;

Route::view('/', 'layout')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    // Existing routes
    // Delivery & Pickup admin configuration
    Route::get('/admin/restaurants/{restaurant}/delivery-config', function ($restaurant) {
        return view('restaurant.delivery', ['restaurant' => $restaurant]);
    })->name('restaurant.delivery-config');
    Route::redirect('dashboard', 'profile')->name('dashboard');
    Route::get('/restaurant/{restaurant}', [ExploreController::class, 'show'])->name('restaurant.show');
    Route::get('/order', \App\Livewire\OrderComponent::class)->name('order');

  
    Route::get('/explore', [ExploreController::class, 'index']) ->name('explore');
    Route::get('/random', [ExploreController::class, 'random'])->name('explore.random');

    Route::get('/profile', \App\Livewire\Pages\User\Profile::class)->name('profile.user');
    Route::get('/restaurant/{restaurant}/manage', \App\Livewire\ManageRestaurant::class)->name('restaurant.manage');
});

// Midtrans Endpoints
Route::post('/midtrans/notification', [App\Http\Controllers\MidtransController::class, 'notification']);
Route::get('/payment/finish', function() {
    return redirect()->route('profile.user')->with('success', 'Pembayaran berhasil dikonfirmasi!');
})->name('payment.finish');
Route::get('/payment/unfinish', function() {
    return redirect()->route('order')->with('warning', 'Pembayaran belum diselesaikan.');
})->name('payment.unfinish');
Route::get('/payment/error', function() {
    return redirect()->route('order')->with('error', 'Terjadi kesalahan saat pembayaran.');
})->name('payment.error');

require __DIR__.'/settings.php';
