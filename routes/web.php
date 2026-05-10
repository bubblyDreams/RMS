<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Settings\PreferenceController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::redirect('/', '/login');

// --- Guest routes -----------------------------------------------------------
Route::middleware('guest')->group(function () {
    Route::get('/login',  [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.attempt');
});

// --- Authenticated + tenant-scoped routes -----------------------------------
Route::middleware(['auth', 'tenant'])->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // User preferences (theme + sidebar state) — JSON, called via fetch/jQuery.
    Route::get  ('/settings/preferences', [PreferenceController::class, 'show'])
        ->name('settings.preferences.show');
    Route::patch('/settings/preferences', [PreferenceController::class, 'update'])
        ->name('settings.preferences.update');
});
