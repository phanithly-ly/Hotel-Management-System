<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


use App\Http\Controllers\RoomController;
use App\Http\Controllers\RoomTypeController;


Route::middleware('auth')->group(function () {
    Route::resource('room-types', RoomTypeController::class)->except('show');
    Route::resource('rooms', RoomController::class)->except('show');
    Route::post('/profile/photo', [ProfileController::class, 'updatePhoto'])->middleware('auth')->name('profile.photo.update');
});

Route::get('/locale/{locale}', function (string $locale) {
    if (in_array($locale, ['en', 'km'])) {
        session(['locale' => $locale]);
    }
    return back();
})->name('locale.switch');


