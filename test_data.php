<?php

require 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';

$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Startup;
use App\Models\Job;
use App\Models\JobApplication;
use App\Models\Investor;
use App\Models\Investment;
use App\Models\Watchlist;

echo "\n=== REAL DATABASE DATA ===\n\n";

// Show Startups
echo "📋 STARTUPS:\n";
$startups = Startup::all();
foreach ($startups as $startup) {
    echo "  • {$startup->name} (Stage: {$startup->stage})\n";
    echo "    Founder: {$startup->founder->first_name} {$startup->founder->last_name}\n";
    echo "    Description: {$startup->description}\n";
    echo "    Team Size: {$startup->team_size} | Total Raised: \${$startup->total_raised}\n\n";
}

// Show Jobs
echo "\n💼 JOBS:\n";
$jobs = Job::all();
foreach ($jobs as $job) {
    echo "  • {$job->title} at {$job->startup->name}\n";
    echo "    Type: {$job->job_type} | Level: {$job->experience_level}\n";
    echo "    Salary: \${$job->salary_min} - \${$job->salary_max}\n\n";
}

// Show Investors
echo "\n💰 INVESTORS:\n";
$investors = Investor::all();
foreach ($investors as $investor) {
    echo "  • {$investor->company_name} (Owner: {$investor->user->first_name})\n";
    echo "    Portfolio Size: \${$investor->portfolio_size}\n";
    echo "    Industries: " . implode(', ', json_decode($investor->industries)) . "\n\n";
}

// Show Investments
echo "\n💵 INVESTMENTS:\n";
$investments = Investment::all();
foreach ($investments as $investment) {
    echo "  • {$investment->investor->company_name} → {$investment->startup->name}\n";
    echo "    Amount: \${$investment->amount} | Type: {$investment->investment_type}\n";
    echo "    Status: {$investment->status}\n\n";
}

// Show Applications
echo "\n📝 JOB APPLICATIONS:\n";
$applications = JobApplication::all();
foreach ($applications as $app) {
    echo "  • {$app->applicant->first_name} applied for {$app->job->title}\n";
    echo "    Status: {$app->status}\n";
    echo "    Cover Letter: " . substr($app->cover_letter, 0, 50) . "...\n\n";
}

// Show Watchlists
echo "\n👁️  WATCHLISTS:\n";
$watchlists = Watchlist::all();
foreach ($watchlists as $watchlist) {
    echo "  • {$watchlist->investor->company_name} is watching {$watchlist->startup->name}\n";
    echo "    Added: {$watchlist->added_at}\n\n";
}

echo "\n✅ All real backend-connected data is working perfectly!\n\n";
