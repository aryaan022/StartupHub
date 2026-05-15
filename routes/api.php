<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\StartupController;
use App\Http\Controllers\Api\JobController;
use App\Http\Controllers\Api\InvestorController;
use App\Http\Controllers\Api\MessageController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::prefix('v1')->group(function () {
    // Public Auth Routes
    Route::post('/auth/register', [AuthController::class, 'register'])->name('auth.register');
    Route::post('/auth/login', [AuthController::class, 'login'])->name('auth.login');

    // Protected Routes
    Route::middleware('auth:sanctum')->group(function () {
        // Auth
        Route::post('/auth/logout', [AuthController::class, 'logout'])->name('auth.logout');
        Route::get('/auth/me', [AuthController::class, 'getCurrentUser'])->name('auth.me');

        // Startups
        Route::get('/startups', [StartupController::class, 'index'])->name('startups.index');
        Route::get('/startups/{id}', [StartupController::class, 'show'])->name('startups.show');
        Route::post('/startups', [StartupController::class, 'store'])->name('startups.store');
        Route::patch('/startups/{id}', [StartupController::class, 'update'])->name('startups.update');
        Route::get('/startups/{id}/stats', [StartupController::class, 'getStats'])->name('startups.stats');

        // Jobs
        Route::get('/jobs', [JobController::class, 'index'])->name('jobs.index');
        Route::get('/jobs/{id}', [JobController::class, 'show'])->name('jobs.show');
        Route::post('/jobs', [JobController::class, 'store'])->name('jobs.store');
        Route::post('/jobs/{id}/apply', [JobController::class, 'apply'])->name('jobs.apply');
        Route::get('/jobs/{id}/applications', [JobController::class, 'getApplications'])->name('jobs.applications');

        // Investors
        Route::get('/investor/profile', [InvestorController::class, 'getProfile'])->name('investor.profile');
        Route::patch('/investor/profile', [InvestorController::class, 'updateProfile'])->name('investor.profile.update');
        Route::get('/investor/watchlist', [InvestorController::class, 'getWatchlist'])->name('investor.watchlist');
        Route::post('/investor/watchlist/{startup_id}', [InvestorController::class, 'addToWatchlist'])->name('investor.watchlist.add');
        Route::delete('/investor/watchlist/{startup_id}', [InvestorController::class, 'removeFromWatchlist'])->name('investor.watchlist.remove');
        Route::get('/investor/investments', [InvestorController::class, 'getInvestments'])->name('investor.investments');
        Route::post('/investor/investments/{startup_id}', [InvestorController::class, 'createInvestment'])->name('investor.investment.create');

        // Messages
        Route::get('/messages', [MessageController::class, 'getConversations'])->name('messages.conversations');
        Route::get('/messages/{user_id}', [MessageController::class, 'getConversation'])->name('messages.conversation');
        Route::post('/messages/{user_id}', [MessageController::class, 'send'])->name('messages.send');
        Route::patch('/messages/{id}/read', [MessageController::class, 'markAsRead'])->name('messages.read');
        Route::get('/messages/unread/count', [MessageController::class, 'getUnreadCount'])->name('messages.unread');
    });

    // Health check
    Route::get('/health', function () {
        return response()->json(['status' => 'ok']);
    });
});
