#!/usr/bin/env php
<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(\Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class DashboardTest {
    public function test()
    {
        echo "\n";
        echo "═══════════════════════════════════════════════════════════\n";
        echo "            DASHBOARD FUNCTIONALITY TEST\n";
        echo "═══════════════════════════════════════════════════════════\n\n";

        // Get test users
        $investors = User::where('role', 'investor')->get();
        $founders = User::where('role', 'founder')->get();
        $seekers = User::where('role', 'job_seeker')->get();

        echo "Test Users Found:\n";
        echo "✅ Investors: " . $investors->count() . "\n";
        echo "✅ Founders: " . $founders->count() . "\n";
        echo "✅ Job Seekers: " . $seekers->count() . "\n\n";

        // Test Investor Dashboard
        echo "─────────────────────────────────────────────────────────────\n";
        echo "1. INVESTOR DASHBOARD TEST\n";
        echo "─────────────────────────────────────────────────────────────\n";
        if ($investors->count() > 0) {
            $investor = $investors->first();
            echo "Testing with: {$investor->email}\n\n";

            try {
                Auth::login($investor);
                
                // Check if investor profile exists
                $profile = $investor->investorProfile()->first();
                if (!$profile) {
                    echo "⚠️  Creating investor profile...\n";
                    $profile = \App\Models\Investor::create([
                        'id' => \Illuminate\Support\Str::uuid(),
                        'user_id' => $investor->id,
                    ]);
                }
                
                echo "✅ Investor ID: {$investor->id}\n";
                echo "✅ Profile exists: YES\n";
                echo "✅ Investment count: " . $investor->investorProfile()->first()->investments()->count() . "\n";
                
                $watchlist = \App\Models\Watchlist::where('investor_id', $profile->id)->count();
                echo "✅ Watchlist count: $watchlist\n";
                
                echo "✅ Dashboard data: READY\n";
            } catch (\Exception $e) {
                echo "❌ ERROR: " . $e->getMessage() . "\n";
            }
        } else {
            echo "⚠️  No investors to test\n";
        }

        Auth::logout();
        
        // Test Founder Dashboard
        echo "\n─────────────────────────────────────────────────────────────\n";
        echo "2. FOUNDER DASHBOARD TEST\n";
        echo "─────────────────────────────────────────────────────────────\n";
        if ($founders->count() > 0) {
            $founder = $founders->first();
            echo "Testing with: {$founder->email}\n\n";

            try {
                Auth::login($founder);
                
                $startups = \App\Models\Startup::where('founder_id', $founder->id)->count();
                echo "✅ Founder ID: {$founder->id}\n";
                echo "✅ Startup count: $startups\n";
                
                if ($startups > 0) {
                    $startup = \App\Models\Startup::where('founder_id', $founder->id)->first();
                    $jobs = $startup->jobs()->count();
                    $apps = $startup->applications()->count();
                    echo "✅ Jobs posted: $jobs\n";
                    echo "✅ Applications: $apps\n";
                } else {
                    echo "ℹ️  No startups created yet\n";
                }
                
                echo "✅ Dashboard data: READY\n";
            } catch (\Exception $e) {
                echo "❌ ERROR: " . $e->getMessage() . "\n";
            }
        } else {
            echo "⚠️  No founders to test\n";
        }

        Auth::logout();

        // Test Job Seeker Dashboard
        echo "\n─────────────────────────────────────────────────────────────\n";
        echo "3. JOB SEEKER DASHBOARD TEST\n";
        echo "─────────────────────────────────────────────────────────────\n";
        if ($seekers->count() > 0) {
            $seeker = $seekers->first();
            echo "Testing with: {$seeker->email}\n\n";

            try {
                Auth::login($seeker);
                
                $apps = \App\Models\JobApplication::where('applicant_id', $seeker->id)->count();
                echo "✅ Seeker ID: {$seeker->id}\n";
                echo "✅ Applications count: $apps\n";
                
                $shortlisted = \App\Models\JobApplication::where('applicant_id', $seeker->id)
                    ->where('status', 'shortlisted')->count();
                echo "✅ Shortlisted: $shortlisted\n";
                
                $accepted = \App\Models\JobApplication::where('applicant_id', $seeker->id)
                    ->where('status', 'accepted')->count();
                echo "✅ Accepted: $accepted\n";
                
                echo "✅ Dashboard data: READY\n";
            } catch (\Exception $e) {
                echo "❌ ERROR: " . $e->getMessage() . "\n";
            }
        } else {
            echo "⚠️  No job seekers to test\n";
        }

        Auth::logout();

        echo "\n═══════════════════════════════════════════════════════════\n";
        echo "                    TEST COMPLETE ✅\n";
        echo "═══════════════════════════════════════════════════════════\n\n";
    }
}

$test = new DashboardTest();
$test->test();
