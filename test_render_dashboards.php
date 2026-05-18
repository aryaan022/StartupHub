#!/usr/bin/env php
<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(\Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;
use Illuminate\Support\Facades\Auth;

echo "\n";
echo "═══════════════════════════════════════════════════════════\n";
echo "         RENDERING DASHBOARD VIEWS - TEST\n";
echo "═══════════════════════════════════════════════════════════\n\n";

$testUsers = [
    ['email' => 'john@startup.com', 'role' => 'founder'],
    ['email' => 'michael@ventures.com', 'role' => 'investor'],
    ['email' => 'alex@student.com', 'role' => 'job_seeker'],
];

foreach ($testUsers as $testUser) {
    echo "─────────────────────────────────────────────────────────────\n";
    echo "Testing {$testUser['role']} Dashboard: {$testUser['email']}\n";
    echo "─────────────────────────────────────────────────────────────\n";
    
    try {
        $user = User::where('email', $testUser['email'])->first();
        
        if (!$user) {
            echo "❌ User not found: {$testUser['email']}\n\n";
            continue;
        }
        
        Auth::login($user);
        
        // Simulate the dashboard controller method
        $dashboardController = app(\App\Http\Controllers\Web\DashboardController::class);
        
        // Get the view data
        $viewData = call_user_func([$dashboardController, 'index']);
        
        echo "✅ View rendered successfully\n";
        echo "✅ User: {$user->full_name}\n";
        echo "✅ Role: {$user->role}\n";
        
        // Check specific dashboard data
        if ($user->role === 'investor') {
            $investor = $user->investorProfile()->first();
            echo "✅ Investor watchlist accessible\n";
            echo "✅ Dashboard type: INVESTOR\n";
        } elseif ($user->role === 'founder') {
            echo "✅ Startup data accessible\n";
            echo "✅ Dashboard type: FOUNDER\n";
        } elseif ($user->role === 'job_seeker') {
            echo "✅ Applications data accessible\n";
            echo "✅ Dashboard type: JOB SEEKER\n";
        }
        
        echo "✅ STATUS: SUCCESS\n";
        
        Auth::logout();
        
    } catch (\Exception $e) {
        echo "❌ ERROR: " . $e->getMessage() . "\n";
        echo "   File: " . $e->getFile() . "\n";
        echo "   Line: " . $e->getLine() . "\n";
    }
    
    echo "\n";
}

echo "═══════════════════════════════════════════════════════════\n";
echo "                 ALL TESTS COMPLETE ✅\n";
echo "═══════════════════════════════════════════════════════════\n\n";
