# Architecture & Design Patterns

## System Architecture

```
┌─────────────────────────────────────────────────────────────┐
│                    Client Layer                             │
│        (Web Browser, Mobile App, Desktop Client)            │
└────────────────────┬────────────────────────────────────────┘
                     │ HTTPS/JSON
                     ▼
┌─────────────────────────────────────────────────────────────┐
│              Load Balancer (Nginx/HAProxy)                  │
│                                                              │
│  - SSL Termination                                           │
│  - Request Routing                                           │
│  - Rate Limiting                                             │
└────────────────────┬────────────────────────────────────────┘
                     │
       ┌─────────────┼─────────────┐
       ▼             ▼             ▼
    ┌──────┐    ┌──────┐    ┌──────┐
    │App 1 │    │App 2 │    │App 3 │
    └──────┘    └──────┘    └──────┘
       │             │             │
       └─────────────┼─────────────┘
                     │
       ┌─────────────┼──────────────────────┐
       │             │                      │
       ▼             ▼                      ▼
    ┌────────┐  ┌─────────┐          ┌──────────┐
    │ Cache  │  │Database │          │  Queue   │
    │(Redis) │  │(Postgres)          │(Redis)   │
    └────────┘  └─────────┘          └──────────┘
                     │                      │
              ┌──────┴──────┐               ▼
              ▼             ▼            ┌──────────┐
         ┌────────┐    ┌────────┐        │ Workers  │
         │ Replicas│    │ Backups│        └──────────┘
         └────────┘    └────────┘
```

## API Layer Architecture

```php
Request → Middleware → Controller → Request Validation →
    ↓
Service Layer (Business Logic) →
    ↓
Model/Repository Layer (Database Queries) →
    ↓
Database →
    ↓
Model/Repository Returns Data →
    ↓
Service Formats Response →
    ↓
Controller Returns Response → Middleware → Client
```

## Design Patterns Used

### 1. Singleton Pattern
```php
// Used for services that should have only one instance
class AuthService
{
    private static $instance;

    public static function getInstance()
    {
        if (null === self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }
}
```

### 2. Factory Pattern
```php
// Create objects without specifying their classes
class PaymentServiceFactory
{
    public static function create($provider)
    {
        return match($provider) {
            'stripe' => new StripePaymentService(),
            'razorpay' => new RazorpayPaymentService(),
            default => throw new InvalidProviderException(),
        };
    }
}
```

### 3. Strategy Pattern
```php
// Different implementations of an interface
interface SearchStrategy {
    public function search($query);
}

class ElasticsearchStrategy implements SearchStrategy {
    public function search($query) { /* ... */ }
}

class DatabaseSearchStrategy implements SearchStrategy {
    public function search($query) { /* ... */ }
}
```

### 4. Observer Pattern
```php
// Trigger actions when events occur
Event::listen('startup.created', function($startup) {
    // Send notifications
    // Sync search index
    // Create activity log
});
```

### 5. Repository Pattern
```php
// Abstraction for data access
interface StartupRepository {
    public function find($id);
    public function all();
    public function create($data);
    public function update($id, $data);
    public function delete($id);
}
```

## Service Layer Architecture

### Example: Investment Service

```php
<?php

namespace App\Services;

use App\Models\Investment;
use App\Models\Startup;
use App\Repositories\InvestmentRepository;
use Illuminate\Database\Transactions\AfterCommit;

class InvestmentService
{
    public function __construct(
        private InvestmentRepository $repository,
        private NotificationService $notifications,
        private StripeService $stripe,
        private ActivityLogService $activityLog
    ) {}

    /**
     * Create investment transaction
     * 
     * Steps:
     * 1. Validate investment
     * 2. Process payment
     * 3. Create investment record
     * 4. Update startup funding
     * 5. Send notifications
     * 6. Log activity
     */
    public function createInvestment($investor, $startup, $amount)
    {
        try {
            DB::beginTransaction();

            // Validate
            $this->validateInvestment($investor, $startup, $amount);

            // Process payment
            $paymentIntent = $this->stripe->createPaymentIntent(
                $amount,
                $investor->email
            );

            // Create investment record
            $investment = $this->repository->create([
                'investor_id' => $investor->id,
                'startup_id' => $startup->id,
                'amount' => $amount,
                'status' => 'completed',
            ]);

            // Update startup
            $startup->increment('total_raised', $amount);

            DB::commit();

            // Send notifications
            $this->notifications->notifyInvestmentReceived($startup, $investor, $investment);

            // Log activity
            $this->activityLog->log('investment_created', 'Investment', $investment->id);

            return $investment;

        } catch (Exception $e) {
            DB::rollBack();
            throw new InvestmentFailedException($e->getMessage());
        }
    }

    private function validateInvestment($investor, $startup, $amount)
    {
        if (!$investor->is_verified) {
            throw new UnverifiedInvestorException();
        }

        if ($amount < 1000) {
            throw new MinimumAmountException();
        }
    }
}
```

## Caching Strategy

### Cache Layers

```
┌─────────────────────────────────────────┐
│        Browser Cache (Client-side)      │
│     ETags, Cache-Control Headers        │
└─────────────────┬───────────────────────┘
                  │
┌─────────────────▼───────────────────────┐
│       Application Cache (Redis)         │
│  - Query Results                        │
│  - Session Data                         │
│  - Rate Limiting                        │
└─────────────────┬───────────────────────┘
                  │
┌─────────────────▼───────────────────────┐
│         Database Query Cache            │
│   ORM-level Caching (Eloquent)          │
└─────────────────┬───────────────────────┘
                  │
┌─────────────────▼───────────────────────┐
│         Database (PostgreSQL)           │
│    Query Cache & Indexes                │
└─────────────────────────────────────────┘
```

### Cache Implementation

```php
// Cache startup details for 1 hour
$startup = Cache::remember("startup.{$id}", 3600, function () use ($id) {
    return Startup::with('founder', 'profile', 'jobs')
        ->findOrFail($id);
});

// Invalidate cache on update
Event::listen('startup.updated', function($startup) {
    Cache::forget("startup.{$startup->id}");
    Cache::forget("startups.all");
});
```

## Queue & Job Processing

### Background Job Flow

```
User Action → Create Job → Add to Queue →
    ↓
Queue Worker picks up job →
    ↓
Job executes in background →
    ↓
Update database →
    ↓
Send notification/email →
    ↓
Log activity
```

### Example: Send Notification Job

```php
<?php

namespace App\Jobs;

use App\Models\User;
use App\Models\Notification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendNotificationJob implements ShouldQueue
{
    use Queueable;

    public $tries = 3;
    public $timeout = 30;

    public function __construct(
        private User $user,
        private string $type,
        private string $title,
        private ?string $description = null
    ) {}

    public function handle()
    {
        // Create notification record
        $notification = Notification::create([
            'user_id' => $this->user->id,
            'type' => $this->type,
            'title' => $this->title,
            'description' => $this->description,
        ]);

        // Send email if enabled
        if ($this->user->email_notifications_enabled) {
            Mail::to($this->user)->send(
                new NotificationEmail($notification)
            );
        }

        // Send push notification
        if ($this->user->has_mobile_app) {
            PushService::send($this->user, $notification);
        }

        // Broadcast real-time notification
        if (config('features.realtime_notifications')) {
            broadcast(new NotificationReceived($notification));
        }
    }

    public function failed(Exception $exception)
    {
        // Log failed job
        Log::error('Notification job failed', [
            'user_id' => $this->user->id,
            'exception' => $exception->getMessage(),
        ]);
    }
}
```

## Error Handling & Exception Strategy

### Custom Exceptions

```php
namespace App\Exceptions;

class StartupException extends Exception {}
class UnverifiedException extends StartupException {}
class InsufficientFundsException extends StartupException {}
class PaymentFailedException extends StartupException {}
```

### Global Exception Handler

```php
public function render($request, Exception $exception)
{
    if ($exception instanceof UnverifiedException) {
        return response()->json([
            'success' => false,
            'message' => 'Verification required',
        ], 403);
    }

    if ($exception instanceof PaymentFailedException) {
        return response()->json([
            'success' => false,
            'message' => 'Payment processing failed',
        ], 402);
    }

    return parent::render($request, $exception);
}
```

## Scalability Considerations

### Horizontal Scaling
- Stateless application servers
- Shared session storage (Redis)
- Load balancer distribution
- Database connection pooling

### Vertical Scaling
- Optimize database queries
- Increase caching
- Upgrade server resources
- Optimize code performance

### Database Scaling
- Read replicas for queries
- Write master for mutations
- Connection pooling (PgBouncer)
- Query optimization & indexing
- Partitioning for large tables

## Security Considerations

- **Input Validation**: Validate all user input
- **Output Encoding**: Encode data before output
- **Authentication**: Secure token management
- **Authorization**: Role-based access control
- **Encryption**: Sensitive data encrypted
- **Logging**: Audit trail for all actions
- **Rate Limiting**: Prevent abuse
- **CORS**: Restrict cross-origin requests
