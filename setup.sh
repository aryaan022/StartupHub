#!/bin/bash

# StartupHub - Project Setup Script
# This script sets up the complete Laravel project

echo "🚀 StartupHub - Project Setup"
echo "=================================="

# Check for required tools
command -v composer >/dev/null 2>&1 || { echo "Composer is required but not installed."; exit 1; }
command -v php >/dev/null 2>&1 || { echo "PHP is required but not installed."; exit 1; }
command -v node >/dev/null 2>&1 || { echo "Node.js is required but not installed."; exit 1; }

echo "✅ All prerequisites installed"

# Create Laravel project
echo "📦 Creating Laravel project..."
laravel new startup-hub
cd startup-hub

# Install additional packages
echo "📥 Installing required packages..."
composer require \
    laravel/sanctum \
    laravel/horizon \
    pusher/pusher-php-server \
    spatie/laravel-permission \
    spatie/laravel-sluggable \
    laravel/pulse \
    sentry/sentry-laravel \
    stripe/stripe-php

# Dev dependencies
composer require --dev \
    laravel/sail \
    laravel/tinker

# Frontend dependencies
npm install
npm install -D \
    tailwindcss \
    postcss \
    autoprefixer \
    @tailwindcss/forms \
    gsap \
    axios

# Initialize Tailwind
npx tailwindcss init -p

# Publish packages
php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
php artisan vendor:publish --provider="Laravel\Horizon\HorizonServiceProvider"

# Create directories
mkdir -p storage/uploads
mkdir -p storage/uploads/avatars
mkdir -p storage/uploads/logos
mkdir -p storage/uploads/pitch-decks
mkdir -p storage/uploads/resumes
mkdir -p database/seeders/fixtures

# Generate key
php artisan key:generate

echo "✅ Setup complete!"
echo ""
echo "Next steps:"
echo "1. Configure .env file with database credentials"
echo "2. Run 'php artisan migrate' to create database tables"
echo "3. Run 'npm run dev' to start development server"
echo "4. Run 'php artisan serve' to start Laravel"
