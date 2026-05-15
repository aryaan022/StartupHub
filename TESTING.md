# Testing Guide

## Test Structure

```
tests/
├── Feature/
│   ├── Auth/
│   ├── Startup/
│   ├── Job/
│   └── Investor/
├── Unit/
│   ├── Models/
│   ├── Services/
│   └── Middleware/
└── Fixtures/
    └── ...
```

## Running Tests

### Run All Tests
```bash
php artisan test
```

### Run Specific Test File
```bash
php artisan test tests/Feature/Auth/LoginTest.php
```

### Run Specific Test Method
```bash
php artisan test tests/Feature/Auth/LoginTest.php --filter=test_user_can_login
```

### Generate Code Coverage
```bash
php artisan test --coverage
php artisan test --coverage-html coverage
```

## Feature Tests

### Authentication Tests

```php
// tests/Feature/Auth/LoginTest.php

namespace Tests\Feature\Auth;

use Tests\TestCase;
use App\Models\User;

class LoginTest extends TestCase
{
    public function test_user_can_login_with_valid_credentials()
    {
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('password123'),
        ]);

        $response = $this->postJson('/api/v1/auth/login', [
            'email' => 'test@example.com',
            'password' => 'password123',
        ]);

        $response->assertStatus(200)
            ->assertJsonStructure(['success', 'user', 'token']);
    }

    public function test_user_cannot_login_with_invalid_credentials()
    {
        User::factory()->create([
            'email' => 'test@example.com',
        ]);

        $response = $this->postJson('/api/v1/auth/login', [
            'email' => 'test@example.com',
            'password' => 'wrongpassword',
        ]);

        $response->assertStatus(401)
            ->assertJson(['success' => false]);
    }
}
```

### Startup Tests

```php
// tests/Feature/Startup/CreateStartupTest.php

namespace Tests\Feature\Startup;

use Tests\TestCase;
use App\Models\User;

class CreateStartupTest extends TestCase
{
    public function test_founder_can_create_startup()
    {
        $user = User::factory()->create(['role' => 'founder']);

        $response = $this->actingAs($user)
            ->postJson('/api/v1/startups', [
                'name' => 'TechStartup',
                'description' => 'A revolutionary startup...',
                'industry' => 'Technology',
                'country' => 'US',
            ]);

        $response->assertStatus(201)
            ->assertJson(['success' => true]);

        $this->assertDatabaseHas('startups', [
            'name' => 'TechStartup',
        ]);
    }

    public function test_job_seeker_cannot_create_startup()
    {
        $user = User::factory()->create(['role' => 'job_seeker']);

        $response = $this->actingAs($user)
            ->postJson('/api/v1/startups', [
                'name' => 'TechStartup',
            ]);

        $response->assertStatus(403);
    }
}
```

## Unit Tests

### Model Tests

```php
// tests/Unit/Models/StartupTest.php

namespace Tests\Unit\Models;

use PHPUnit\Framework\TestCase;
use App\Models\Startup;
use App\Models\User;

class StartupTest extends TestCase
{
    public function test_startup_has_founder()
    {
        $startup = Startup::factory()
            ->for(User::factory(), 'founder')
            ->create();

        $this->assertNotNull($startup->founder);
        $this->assertInstanceOf(User::class, $startup->founder);
    }

    public function test_profile_completion_percentage_calculation()
    {
        $startup = Startup::factory()->create([
            'name' => 'StartupName',
            'description' => 'Startup description',
        ]);

        $percentage = $startup->profile_completion_percentage;
        $this->assertGreater($percentage, 0);
        $this->assertLessThanOrEqual(100, $percentage);
    }
}
```

## Integration Tests

### Job Application Flow

```php
// tests/Feature/Job/ApplicationFlowTest.php

namespace Tests\Feature\Job;

use Tests\TestCase;
use App\Models\User;
use App\Models\Job;

class ApplicationFlowTest extends TestCase
{
    public function test_complete_job_application_flow()
    {
        // Setup
        $founder = User::factory()->create(['role' => 'founder']);
        $jobSeeker = User::factory()->create(['role' => 'job_seeker']);

        // Create startup and job
        $startup = $founder->startup()->create([...]);
        $job = $startup->jobs()->create([...]);

        // Apply for job
        $response = $this->actingAs($jobSeeker)
            ->postJson("/api/v1/jobs/{$job->id}/apply", [
                'cover_letter' => 'I am interested...',
            ]);

        $response->assertStatus(201);

        // Verify application created
        $this->assertDatabaseHas('job_applications', [
            'job_id' => $job->id,
            'applicant_id' => $jobSeeker->id,
        ]);

        // Founder views applications
        $response = $this->actingAs($founder)
            ->getJson("/api/v1/jobs/{$job->id}/applications");

        $response->assertStatus(200)
            ->assertJsonCount(1, 'data.data');
    }
}
```

## Performance Tests

### Load Testing

```bash
# Using Apache Bench
ab -n 1000 -c 100 https://api.startuphub.com/api/v1/startups

# Using wrk
wrk -t12 -c400 -d30s https://api.startuphub.com/api/v1/startups
```

### Database Query Optimization

```php
// tests/Feature/Performance/QueryOptimizationTest.php

namespace Tests\Feature\Performance;

use Tests\TestCase;
use Illuminate\Support\Facades\DB;

class QueryOptimizationTest extends TestCase
{
    public function test_startup_list_uses_eager_loading()
    {
        DB::enableQueryLog();

        // Create startups with relationships
        $startups = Startup::with('founder', 'profile')->limit(20)->get();

        $queryCount = count(DB::getQueryLog());

        // Should only be 3 queries (startups, founders, profiles)
        $this->assertLessThanOrEqual(3, $queryCount);
    }
}
```

## Security Tests

### Authorization Tests

```php
// tests/Feature/Security/AuthorizationTest.php

namespace Tests\Feature\Security;

use Tests\TestCase;
use App\Models\User;
use App\Models\Startup;

class AuthorizationTest extends TestCase
{
    public function test_non_founder_cannot_update_startup()
    {
        $founder = User::factory()->create(['role' => 'founder']);
        $other = User::factory()->create(['role' => 'job_seeker']);
        
        $startup = Startup::factory()
            ->for($founder, 'founder')
            ->create();

        $response = $this->actingAs($other)
            ->patchJson("/api/v1/startups/{$startup->id}", [
                'name' => 'Updated Name',
            ]);

        $response->assertStatus(403);
    }

    public function test_unauthenticated_user_cannot_create_startup()
    {
        $response = $this->postJson('/api/v1/startups', [
            'name' => 'Startup',
        ]);

        $response->assertStatus(401);
    }
}
```

## Mocking & Stubs

### Mock External Services

```php
// Mock Stripe payment
$this->mock(StripeService::class, function ($mock) {
    $mock->shouldReceive('createPayment')
        ->andReturn(['status' => 'succeeded']);
});

// Mock Email
Mail::fake();

$this->actingAs($user)
    ->postJson('/api/v1/auth/register', [...]);

Mail::assertSent(VerificationEmail::class);
```

## Continuous Integration

### GitHub Actions Workflow

```yaml
# .github/workflows/tests.yml

name: Tests

on: [push, pull_request]

jobs:
  test:
    runs-on: ubuntu-latest
    
    services:
      postgres:
        image: postgres:14
        options: >-
          --health-cmd pg_isready
          --health-interval 10s
          --health-timeout 5s
          --health-retries 5
        env:
          POSTGRES_DB: startuphub_test
          POSTGRES_PASSWORD: password

    steps:
      - uses: actions/checkout@v3
      
      - name: Setup PHP
        uses: shivammathur/setup-php@v2
        with:
          php-version: '8.2'
          extensions: pgsql, redis
      
      - name: Install dependencies
        run: composer install
      
      - name: Create .env file
        run: cp .env.example .env
      
      - name: Generate application key
        run: php artisan key:generate
      
      - name: Run tests
        run: php artisan test
```

## Test Coverage Goals

- **Overall**: 80%+ coverage
- **Critical Paths**: 90%+ coverage
- **Controllers**: 85%+ coverage
- **Models**: 75%+ coverage
- **Services**: 85%+ coverage

## Best Practices

1. **Isolation**: Each test should be independent
2. **Clarity**: Test names describe what is being tested
3. **Arrange-Act-Assert**: Follow AAA pattern
4. **DRY**: Use setUp() and tearDown() methods
5. **Mock External**: Mock third-party services
6. **Fast**: Tests should run quickly
7. **Deterministic**: Same result every run
