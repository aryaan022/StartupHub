# StartupHub - Complete Setup Guide

## Overview

This guide covers the complete setup process for StartupHub, from initial development environment setup to production deployment.

## Prerequisites

### Required Software
- **PHP**: 8.2+ with extensions:
  - php-fpm
  - php-pgsql
  - php-redis
  - php-gd
  - php-xml
  - php-curl
  - php-zip
  - php-mbstring

- **Database**: PostgreSQL 14+
- **Cache**: Redis 6+
- **Node.js**: 18+ with npm
- **Composer**: Latest version
- **Git**: Latest version

### Optional Services
- **Stripe**: Payment processing (API keys required)
- **Pusher**: Real-time notifications (optional, can use Laravel Reverb)
- **SendGrid**: Email service (optional)
- **AWS S3**: File storage (optional, can use local storage)

## Local Development Setup

### 1. Environment Setup

#### Windows
```bash
# Install with Chocolatey
choco install php composer nodejs postgresql redis

# Or download manually from:
# PHP: https://windows.php.net/download
# PostgreSQL: https://www.postgresql.org/download/windows
# Redis: https://github.com/microsoftarchive/redis/releases
```

#### macOS
```bash
# Using Homebrew
brew install php composer node postgresql redis

# Or use Sail (Docker)
curl -s https://laravel.build/startup-hub | bash
cd startup-hub
./vendor/bin/sail up
```

#### Linux (Ubuntu/Debian)
```bash
sudo apt update
sudo apt install -y php8.2-fpm php8.2-pgsql php8.2-redis \
    postgresql postgresql-contrib redis-server \
    nginx composer nodejs npm git

sudo systemctl start postgresql redis-server
```

### 2. Clone Repository

```bash
git clone <repository-url>
cd startup-hub
```

### 3. Install Dependencies

```bash
# PHP dependencies
composer install

# Node.js dependencies
npm install

# Create .env file
cp .env.example .env

# Generate application key
php artisan key:generate
```

### 4. Configure Environment

Edit `.env` file with your configuration:

```bash
# Application
APP_NAME="StartupHub"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000

# Database
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=startup_hub_dev
DB_USERNAME=postgres
DB_PASSWORD=password

# Redis
REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

# Cache & Queue
CACHE_DRIVER=redis
QUEUE_CONNECTION=redis

# Mail (Mailtrap for development)
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=465
MAIL_USERNAME=<your-username>
MAIL_PASSWORD=<your-password>
MAIL_FROM_ADDRESS=dev@startuphub.local

# Optional Services
STRIPE_PUBLIC_KEY=pk_test_...
STRIPE_SECRET_KEY=sk_test_...
```

### 5. Database Setup

```bash
# Create PostgreSQL database
createdb startup_hub_dev
createuser startuphub_dev -P

# Grant privileges
psql -U postgres -d startup_hub_dev -c "GRANT ALL PRIVILEGES ON DATABASE startup_hub_dev TO startuphub_dev;"

# Run migrations
php artisan migrate

# Seed data (optional)
php artisan db:seed
```

### 6. Build Assets

```bash
# Development build
npm run dev

# Watch for changes
npm run watch

# Production build
npm run build
```

### 7. Start Development Server

```bash
# Terminal 1: Laravel server
php artisan serve

# Terminal 2: NPM watcher
npm run watch

# Terminal 3: Queue worker
php artisan queue:work

# Terminal 4: Redis (if not running as service)
redis-server
```

Visit http://localhost:8000 in your browser.

## Project Structure

```
startup-hub/
├── app/                 # Application code
├── bootstrap/          # Bootstrap application
├── config/             # Configuration files
├── database/
│   ├── migrations/    # Database migrations
│   ├── factories/     # Model factories
│   └── seeders/       # Database seeders
├── docs/              # Documentation
├── public/            # Public assets
├── resources/         # Views, JS, CSS
├── routes/            # Route definitions
├── storage/           # User uploads, logs
├── tests/             # Test suite
└── vendor/            # Composer dependencies
```

## Common Commands

### Laravel Artisan Commands
```bash
# Database
php artisan migrate              # Run migrations
php artisan migrate:rollback     # Rollback migrations
php artisan migrate:fresh        # Fresh migration
php artisan db:seed             # Run seeders

# Cache
php artisan cache:clear         # Clear cache
php artisan config:cache        # Cache configuration

# Queue
php artisan queue:work          # Process queue jobs
php artisan queue:failed        # Show failed jobs
php artisan queue:retry <id>    # Retry failed job

# Development
php artisan tinker              # Interactive shell
php artisan make:controller <name>  # Generate controller
php artisan make:model <name>   # Generate model

# Testing
php artisan test                # Run test suite
php artisan test --coverage     # With coverage report
```

### NPM Commands
```bash
npm run dev                      # Development build
npm run watch                    # Watch & rebuild
npm run build                    # Production build
npm run format                   # Format code
npm run lint                     # Lint code
```

## Testing

### Run All Tests
```bash
php artisan test
```

### Run Specific Test
```bash
php artisan test tests/Feature/Auth/LoginTest.php
```

### Generate Coverage Report
```bash
php artisan test --coverage
```

## Debugging

### Enable Debug Mode
Edit `.env`:
```
APP_DEBUG=true
```

### Use Laravel Debugbar
```bash
composer require barryvdh/laravel-debugbar --dev
```

### Check Logs
```bash
tail -f storage/logs/laravel.log
```

### Database Debugging
```bash
# Enable query logging
DB::enableQueryLog();

// Execute query
$startups = Startup::all();

// View queries
dd(DB::getQueryLog());
```

## Troubleshooting

### Database Connection Error
```bash
# Check PostgreSQL is running
sudo systemctl status postgresql

# Test connection
psql -h localhost -U postgres -d startup_hub_dev

# Check .env database settings
```

### Queue Not Processing
```bash
# Check Redis is running
redis-cli ping

# Restart queue worker
php artisan queue:work --daemon

# Clear queue
php artisan queue:flush
```

### Cache Issues
```bash
# Clear all caches
php artisan cache:clear

# Clear specific cache
php artisan cache:forget key_name

# Verify Redis connection
redis-cli
> PING
```

### Storage Permission Issues
```bash
sudo chown -R www-data:www-data storage
sudo chmod -R 775 storage
```

## Git Workflow

### Feature Branch
```bash
# Create feature branch
git checkout -b feature/user-authentication

# Make changes and commit
git add .
git commit -m "Add user authentication"

# Push to remote
git push origin feature/user-authentication

# Create pull request on GitHub
```

### Before Committing
```bash
# Format code
npm run format

# Run tests
php artisan test

# Check code quality
php artisan lint
```

## Environment-Specific Setup

### Staging Setup
1. Use staging database
2. Enable debugging for diagnostics
3. Use test payment keys (Stripe)
4. Send test emails only

### Production Setup
See [DEPLOYMENT.md](DEPLOYMENT.md) for complete production setup.

## IDE Setup

### VS Code
```json
// .vscode/extensions.json
{
  "recommendations": [
    "bmewburn.vscode-intelephense-client",
    "esbenp.prettier-vscode",
    "dbaeumer.vscode-eslint",
    "bradlc.vscode-tailwindcss",
    "junstyle.php-cs-fixer"
  ]
}
```

### PHPStorm
- Enable Laravel plugin
- Configure PHP language level to 8.2
- Set up database connection in IDE
- Configure Composer

## Performance Optimization

### Local Development
```bash
# Clear and cache configuration
php artisan config:cache

# Clear views cache if needed
php artisan view:clear
```

### Asset Optimization
```bash
# Minify CSS/JS (production)
npm run build

# Optimize images
php artisan image:optimize
```

## Support & Resources

- **Documentation**: See `/docs` folder
- **API Docs**: [API_DOCUMENTATION.md](API_DOCUMENTATION.md)
- **Security**: [SECURITY.md](SECURITY.md)
- **Architecture**: [ARCHITECTURE.md](ARCHITECTURE.md)

## Getting Help

1. Check existing documentation
2. Search GitHub issues
3. Ask in team Slack channel
4. Create GitHub issue with details

---

**Last Updated**: January 2024
**Maintainers**: StartupHub Team
