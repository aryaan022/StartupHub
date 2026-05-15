# Project Structure Guide

## Directory Organization

```
startup-hub/
│
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   └── Api/
│   │   │       ├── AuthController.php
│   │   │       ├── StartupController.php
│   │   │       ├── JobController.php
│   │   │       ├── InvestorController.php
│   │   │       └── MessageController.php
│   │   ├── Requests/
│   │   │   ├── RegisterRequest.php
│   │   │   ├── LoginRequest.php
│   │   │   ├── CreateStartupRequest.php
│   │   │   └── ...
│   │   ├── Middleware/
│   │   │   └── ApiErrorHandler.php
│   │   └── Resources/
│   │       └── ... (JSON resources)
│   │
│   ├── Models/
│   │   ├── User.php
│   │   ├── Startup.php
│   │   ├── StartupProfile.php
│   │   ├── Job.php
│   │   ├── JobApplication.php
│   │   ├── Investor.php
│   │   ├── Investment.php
│   │   ├── Message.php
│   │   ├── Notification.php
│   │   ├── Watchlist.php
│   │   ├── JobSeekerProfile.php
│   │   ├── StartupTeamMember.php
│   │   ├── UserSkill.php
│   │   └── ActivityLog.php
│   │
│   ├── Services/
│   │   ├── ActivityLogService.php
│   │   ├── NotificationService.php
│   │   ├── PaymentService.php
│   │   ├── EmailService.php
│   │   └── SearchService.php
│   │
│   ├── Jobs/
│   │   ├── SendVerificationEmail.php
│   │   ├── ProcessJobApplication.php
│   │   ├── SendNotification.php
│   │   └── SyncSearchIndex.php
│   │
│   ├── Events/
│   │   ├── StartupCreated.php
│   │   ├── JobApplicationSubmitted.php
│   │   ├── InvestmentProposed.php
│   │   └── MessageSent.php
│   │
│   ├── Listeners/
│   │   ├── SendStartupCreatedNotification.php
│   │   ├── ProcessJobApplicationNotification.php
│   │   └── SyncSearchData.php
│   │
│   ├── Exceptions/
│   │   ├── ValidationException.php
│   │   ├── AuthenticationException.php
│   │   └── PaymentException.php
│   │
│   ├── Mail/
│   │   ├── EmailVerification.php
│   │   ├── PasswordReset.php
│   │   ├── InvestmentProposal.php
│   │   └── JobApplicationStatus.php
│   │
│   ├── Notifications/
│   │   ├── NewJobApplication.php
│   │   ├── InvestmentProposal.php
│   │   ├── MessageReceived.php
│   │   └── ApplicationStatusUpdate.php
│   │
│   └── Console/
│       ├── Commands/
│       │   ├── VerifyUnverifiedUsers.php
│       │   ├── CleanupExpiredTokens.php
│       │   └── GenerateReport.php
│       └── Kernel.php
│
├── database/
│   ├── migrations/
│   │   ├── 2024_01_01_000001_create_users_table.php
│   │   ├── 2024_01_01_000002_create_startups_table.php
│   │   ├── 2024_01_01_000003_create_jobs_table.php
│   │   ├── 2024_01_01_000004_create_job_applications_table.php
│   │   ├── 2024_01_01_000005_create_investors_table.php
│   │   ├── 2024_01_01_000006_create_investments_table.php
│   │   ├── 2024_01_01_000007_create_startup_profiles_table.php
│   │   ├── 2024_01_01_000008_create_startup_team_members_table.php
│   │   ├── 2024_01_01_000009_create_messages_table.php
│   │   ├── 2024_01_01_000010_create_notifications_table.php
│   │   ├── 2024_01_01_000011_create_watchlists_table.php
│   │   ├── 2024_01_01_000012_create_job_seeker_profiles_table.php
│   │   ├── 2024_01_01_000013_create_user_skills_table.php
│   │   └── 2024_01_01_000014_create_activity_logs_table.php
│   │
│   ├── factories/
│   │   ├── UserFactory.php
│   │   ├── StartupFactory.php
│   │   ├── JobFactory.php
│   │   └── ...
│   │
│   └── seeders/
│       ├── DatabaseSeeder.php
│       ├── UserSeeder.php
│       ├── StartupSeeder.php
│       └── JobSeeder.php
│
├── routes/
│   ├── api.php          # API routes
│   ├── web.php          # Web routes (if using Blade)
│   └── channels.php     # Broadcasting channels
│
├── resources/
│   ├── views/
│   │   ├── layouts/
│   │   │   └── app.blade.php
│   │   ├── auth/
│   │   │   ├── register.blade.php
│   │   │   └── login.blade.php
│   │   ├── startup/
│   │   │   ├── index.blade.php
│   │   │   ├── show.blade.php
│   │   │   └── create.blade.php
│   │   └── job/
│   │       ├── index.blade.php
│   │       └── show.blade.php
│   │
│   ├── css/
│   │   ├── app.css
│   │   └── tailwind.css
│   │
│   └── js/
│       ├── app.js
│       ├── api.js
│       └── components/
│           ├── StartupCard.vue
│           ├── JobListing.vue
│           └── ...
│
├── config/
│   ├── app.php
│   ├── database.php
│   ├── mail.php
│   ├── cache.php
│   ├── queue.php
│   ├── permissions.php
│   └── services.php
│
├── storage/
│   ├── app/
│   │   ├── public/
│   │   ├── uploads/
│   │   │   ├── avatars/
│   │   │   ├── logos/
│   │   │   ├── pitch-decks/
│   │   │   └── resumes/
│   │   └── logs/
│   ├── framework/
│   └── logs/
│
├── tests/
│   ├── Feature/
│   │   ├── Auth/
│   │   ├── Startup/
│   │   ├── Job/
│   │   ├── Investor/
│   │   └── Message/
│   ├── Unit/
│   │   ├── Models/
│   │   ├── Services/
│   │   └── Middleware/
│   └── TestCase.php
│
├── docs/
│   ├── API_DOCUMENTATION.md
│   ├── DEPLOYMENT.md
│   ├── SECURITY.md
│   ├── TESTING.md
│   ├── DATABASE_DESIGN.md
│   ├── ARCHITECTURE.md
│   └── CONTRIBUTING.md
│
├── .env.example
├── .env.production
├── .gitignore
├── README.md
├── SETUP.md
├── artisan
├── composer.json
├── package.json
├── phpunit.xml
├── webpack.mix.js
└── docker-compose.yml
```

## File Naming Conventions

### Controllers
- `AuthController.php` - Authentication
- `StartupController.php` - Startup management
- `JobController.php` - Job management
- Suffix: `Controller`

### Models
- `User.php` - User model
- `Startup.php` - Startup model
- `Job.php` - Job model
- No suffix

### Requests (Form Requests)
- `RegisterRequest.php` - Registration validation
- `CreateStartupRequest.php` - Startup creation validation
- Suffix: `Request`

### Services
- `AuthService.php` - Authentication business logic
- `NotificationService.php` - Notification handling
- Suffix: `Service`

### Jobs (Queue Jobs)
- `SendVerificationEmail.php` - Email sending job
- `ProcessJobApplication.php` - Application processing
- No specific suffix, descriptive name

### Events
- `StartupCreated.php` - Startup creation event
- `MessageSent.php` - Message sent event
- No suffix

### Migrations
- `2024_01_01_000001_create_users_table.php`
- Format: `YYYY_MM_DD_HHMMSS_description`

## Code Organization Principles

1. **Single Responsibility**: Each class has one reason to change
2. **Dependency Injection**: Pass dependencies as constructor arguments
3. **Type Hints**: Always use type hints for parameters and return types
4. **Constants**: Define constants in configuration files
5. **Error Handling**: Use custom exceptions
6. **Logging**: Log important operations and errors
7. **Documentation**: Add docblocks to public methods

## Import Organization

```php
<?php

namespace App\Http\Controllers\Api;

// First: Laravel imports
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// Then: Application imports (organized by depth)
use App\Models\User;
use App\Models\Startup;
use App\Http\Requests\CreateStartupRequest;
use App\Services\NotificationService;

class StartupController
{
    // ...
}
```

## Dependency Injection Example

```php
<?php

namespace App\Services;

use App\Models\Notification;
use Illuminate\Mail\Mailable;

class NotificationService
{
    public function __construct(
        private MailerService $mailer,
        private LoggerService $logger
    ) {}

    public function notify($user, $message)
    {
        $this->mailer->send($user->email, $message);
        $this->logger->log("Notification sent to {$user->id}");
    }
}
```

## Configuration Files

### app.php
- Application name
- Debug mode
- Timezone
- Providers
- Aliases

### database.php
- Database connections
- Migration settings
- Connection pooling

### cache.php
- Cache driver
- TTL settings
- Redis configuration

### queue.php
- Queue driver
- Retry settings
- Job batching

### permissions.php
- Role definitions
- Permission mappings
- Feature flags

## Best Practices

1. **DRY (Don't Repeat Yourself)**
   - Extract common functionality into services
   - Reuse components and traits

2. **KISS (Keep It Simple, Stupid)**
   - Prefer simple solutions
   - Avoid over-engineering

3. **YAGNI (You Aren't Gonna Need It)**
   - Don't add features before they're needed
   - Remove unused code

4. **Consistency**
   - Follow naming conventions consistently
   - Use same style throughout

5. **Testing**
   - Write tests alongside code
   - Aim for high coverage
