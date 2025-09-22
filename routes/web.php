<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CardController;
use App\Http\Controllers\PublicCardController;
use App\Http\Controllers\Admin\AdminController;

// Home (replace Breeze's Welcome if you prefer a custom home)
Route::get('/', fn () => Inertia::render('Home/Index', [
    'laravelVersion' => Application::VERSION,
    'phpVersion'     => PHP_VERSION,
]))->name('home');

// Dashboard (now uses your CardController@dashboard)
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [CardController::class, 'dashboard'])->name('dashboard');
    Route::resource('cards', CardController::class); // index/create/store/show/edit/update/destroy
});

// Public profile
Route::get('/u/{slug}', [PublicCardController::class, 'show'])->name('card.public');

// Admin area
Route::middleware(['auth', 'can:admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
});

// Breeze profile routes (keep)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
