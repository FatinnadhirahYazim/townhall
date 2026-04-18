<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VenueController;
use App\Http\Controllers\BookingController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/venues/{venue:slug}', [VenueController::class, 'show'])->name('venues.show');

Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');
Route::get('/bookings/{booking}/success', [BookingController::class, 'success'])->name('bookings.success');

Route::middleware(['auth', 'verified'])->name('dashboard')->get('/dashboard', function () {
    return view('dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/my-bookings', [\App\Http\Controllers\UserBookingController::class, 'index'])->name('bookings.index');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
    Route::resource('venues', \App\Http\Controllers\Admin\VenueController::class);
    Route::patch('/bookings/{booking}/status/{status}', [\App\Http\Controllers\Admin\DashboardController::class, 'updateBookingStatus'])->name('bookings.status');
});

require __DIR__.'/auth.php';
