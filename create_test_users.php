<?php

use App\Models\User;
use App\Models\Startup;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(\Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

// Create founder with startup and jobs
$founder = User::firstOrCreate(
    ['email' => 'jane.founder@test.com'],
    [
        'id' => Str::uuid(),
        'first_name' => 'Jane',
        'last_name' => 'Founder',
        'password' => Hash::make('password123'),
        'role' => 'founder',
        'is_active' => true,
    ]
);

// Create startup
if (!$founder->startup()->exists()) {
    $startup = Startup::create([
        'id' => Str::uuid(),
        'founder_id' => $founder->id,
        'name' => 'TechStartup Inc',
        'slug' => Str::slug('TechStartup Inc'),
        'description' => 'A innovative tech startup',
        'industry' => 'Technology',
        'stage' => 'seed',
        'visibility' => 'public',
    ]);
}

// Create job seeker
$seeker = User::firstOrCreate(
    ['email' => 'bob.seeker@test.com'],
    [
        'id' => Str::uuid(),
        'first_name' => 'Bob',
        'last_name' => 'Seeker',
        'password' => Hash::make('password123'),
        'role' => 'job_seeker',
        'is_active' => true,
    ]
);

echo "✅ Test users created!\n";
echo "Founder: jane.founder@test.com | pass: password123\n";
echo "Job Seeker: bob.seeker@test.com | pass: password123\n";
echo "Investor: john.investor@test.com | pass: password123\n";
