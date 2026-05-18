<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\AuthWebController;
use App\Http\Controllers\Web\DashboardController;
use App\Http\Controllers\Web\StartupWebController;
use App\Http\Controllers\Web\JobWebController;
use App\Http\Controllers\Web\InvestorWebController;
use App\Http\Controllers\Web\ResourcesController;
use App\Http\Controllers\Web\InvestmentController;

// ── Public ────────────────────────────────────────────────────────────────────
Route::get('/',          [HomeController::class, 'index'])->name('home');
Route::get('/discover',  [StartupWebController::class, 'discover'])->name('discover');
Route::get('/jobs',      [JobWebController::class, 'index'])->name('jobs.index');
Route::get('/jobs/{id}', [JobWebController::class, 'show'])->name('jobs.show');
Route::get('/investors', [InvestorWebController::class, 'index'])->name('investors.index');
Route::get('/funding',   [InvestorWebController::class, 'funding'])->name('funding.index');
Route::get('/resources', [ResourcesController::class, 'index'])->name('resources.index');

// Startup public profile (must be before auth group to allow public viewing)
Route::get('/startups/{id}', [StartupWebController::class, 'show'])->name('startups.show');

// ── Guest only ────────────────────────────────────────────────────────────────
Route::middleware('guest')->group(function () {
    Route::get('/login',           [AuthWebController::class, 'showLogin'])->name('login');
    Route::post('/login',          [AuthWebController::class, 'login'])->name('login.submit');
    Route::get('/register',        [AuthWebController::class, 'showRegister'])->name('register');
    Route::post('/register',       [AuthWebController::class, 'register'])->name('register.submit');
    Route::get('/forgot-password', fn() => view('auth.login'))->name('password.request');
});

Route::post('/logout', [AuthWebController::class, 'logout'])->name('logout')->middleware('auth');

// ── Authenticated ─────────────────────────────────────────────────────────────
Route::middleware('auth')->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Profile
    Route::get('/profile',           [DashboardController::class, 'profile'])->name('profile.edit');
    Route::post('/profile',          [DashboardController::class, 'updateProfile'])->name('profile.update');
    Route::post('/profile/password', [DashboardController::class, 'updatePassword'])->name('profile.password');

    // Startups — specific routes before dynamic {id}
    Route::get('/startups/create',       [StartupWebController::class, 'create'])->name('startups.create');
    Route::post('/startups',             [StartupWebController::class, 'store'])->name('startups.store');
    Route::get('/startups/{id}/manage',  [StartupWebController::class, 'manage'])->name('startups.manage');
    Route::post('/startups/{id}/update', [StartupWebController::class, 'update'])->name('startups.update');

    // Jobs
    Route::get('/jobs/create',                          [JobWebController::class, 'create'])->name('jobs.create');
    Route::post('/jobs',                                [JobWebController::class, 'store'])->name('jobs.store');
    Route::post('/jobs/{id}/apply',                     [JobWebController::class, 'apply'])->name('jobs.apply');
    Route::post('/applications/{id}/status',            [JobWebController::class, 'updateApplicationStatus'])->name('applications.status');

    // Investor / Watchlist
    Route::get('/watchlist',                            [InvestorWebController::class, 'watchlist'])->name('watchlist.index');
    Route::post('/watchlist/{startupId}',               [InvestorWebController::class, 'addToWatchlist'])->name('watchlist.add');
    Route::delete('/watchlist/{startupId}',             [InvestorWebController::class, 'removeFromWatchlist'])->name('watchlist.remove');

    // Investments
    Route::get('/startups/{id}/invest',                 [InvestmentController::class, 'create'])->name('investments.create');
    Route::post('/investments',                         [InvestmentController::class, 'store'])->name('investments.store');
    Route::get('/portfolio',                            [InvestmentController::class, 'portfolio'])->name('investments.portfolio');
    Route::delete('/investments/{id}',                  [InvestmentController::class, 'cancel'])->name('investments.cancel');

    // Other pages
    Route::get('/messages',      fn() => view('messages.index'))->name('messages.index');
    Route::get('/notifications', fn() => view('notifications.index'))->name('notifications.index');
    Route::get('/settings',      fn() => view('settings.index'))->name('settings.index');

    // Admin
    Route::get('/admin/dashboard', [DashboardController::class, 'admin'])->name('admin.dashboard');
});
