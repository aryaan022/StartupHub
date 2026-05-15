# Deployment Guide

## Pre-Deployment Checklist

### 1. Environment Setup
- [ ] Clone repository
- [ ] Copy `.env.example` to `.env`
- [ ] Configure all environment variables
- [ ] Generate application key: `php artisan key:generate`
- [ ] Test database connection

### 2. Database Preparation
- [ ] Create PostgreSQL database
- [ ] Run migrations: `php artisan migrate --force`
- [ ] Seed data (optional): `php artisan db:seed --force`
- [ ] Verify all tables created
- [ ] Create backup before deployment

### 3. Dependencies
- [ ] Install PHP dependencies: `composer install --no-dev`
- [ ] Install Node dependencies: `npm install`
- [ ] Build assets: `npm run build`
- [ ] Verify no security vulnerabilities: `composer audit`, `npm audit`

### 4. Configuration Caching
- [ ] Cache configuration: `php artisan config:cache`
- [ ] Cache routes: `php artisan route:cache`
- [ ] Cache views: `php artisan view:cache`
- [ ] Clear old caches: `php artisan cache:clear`

## Deployment Steps

### 1. Server Setup (Linux/Ubuntu)

#### Create App User
```bash
sudo useradd -m -d /var/www/startuphub startuphub
sudo usermod -s /bin/bash startuphub
```

#### Install Dependencies
```bash
sudo apt-get update
sudo apt-get install -y php8.2 php8.2-fpm php8.2-pgsql php8.2-redis
sudo apt-get install -y postgresql postgresql-contrib
sudo apt-get install -y nginx certbot python3-certbot-nginx
sudo apt-get install -y supervisor redis-server
```

#### Clone Repository
```bash
sudo -u startuphub git clone <repo-url> /var/www/startuphub
cd /var/www/startuphub
sudo -u startuphub composer install --no-dev
sudo -u startuphub npm install && npm run build
```

### 2. Web Server Configuration (Nginx)

```nginx
# /etc/nginx/sites-available/startuphub
server {
    listen 443 ssl http2;
    server_name api.startuphub.com;

    ssl_certificate /etc/letsencrypt/live/api.startuphub.com/fullchain.pem;
    ssl_certificate_key /etc/letsencrypt/live/api.startuphub.com/privkey.pem;

    # Security headers
    add_header X-Frame-Options "SAMEORIGIN" always;
    add_header X-Content-Type-Options "nosniff" always;
    add_header X-XSS-Protection "1; mode=block" always;
    add_header Referrer-Policy "strict-origin-when-cross-origin" always;

    root /var/www/startuphub/public;
    index index.php;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        fastcgi_split_path_info ^(.+\.php)(/.+)$;
        fastcgi_pass unix:/var/run/php/php8.2-fpm.sock;
        fastcgi_index index.php;
        include fastcgi_params;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
    }

    location ~ /\.ht {
        deny all;
    }

    location ~* \.(jpg|jpeg|png|gif|ico|css|js|svg|woff|woff2|ttf|eot)$ {
        expires 30d;
        add_header Cache-Control "public, immutable";
    }
}

# Redirect HTTP to HTTPS
server {
    listen 80;
    server_name api.startuphub.com;
    return 301 https://$server_name$request_uri;
}
```

#### Enable Site
```bash
sudo ln -s /etc/nginx/sites-available/startuphub /etc/nginx/sites-enabled/
sudo nginx -t
sudo systemctl restart nginx
```

### 3. SSL Certificate

```bash
# Using Let's Encrypt with Certbot
sudo certbot certonly --nginx -d api.startuphub.com -d www.startuphub.com

# Auto-renewal
sudo systemctl enable certbot.timer
```

### 4. Database Setup

```bash
# Create PostgreSQL user and database
sudo -u postgres createuser startuphub_user
sudo -u postgres createdb -O startuphub_user startuphub_prod

# Configure PostgreSQL
# Edit /etc/postgresql/14/main/postgresql.conf
max_connections = 200
shared_buffers = 256MB
effective_cache_size = 1GB

sudo systemctl restart postgresql
```

### 5. Queue Processing

```bash
# Create supervisor config for queue workers
# /etc/supervisor/conf.d/startuphub-worker.conf

[program:startuphub-worker]
process_name=%(program_name)s_%(process_num)02d
command=php /var/www/startuphub/artisan queue:work redis --sleep=3 --tries=3
autostart=true
autorestart=true
user=startuphub
numprocs=4
redirect_stderr=true
stdout_logfile=/var/log/startuphub/worker.log

# Enable supervisor
sudo supervisorctl reread
sudo supervisorctl update
sudo supervisorctl start startuphub-worker:*
```

### 6. Cron Job

```bash
# Add Laravel scheduler to crontab
# sudo -u startuphub crontab -e

* * * * * cd /var/www/startuphub && php artisan schedule:run >> /dev/null 2>&1
```

### 7. File Permissions

```bash
sudo chown -R startuphub:startuphub /var/www/startuphub
sudo chmod -R 755 /var/www/startuphub
sudo chmod -R 775 /var/www/startuphub/storage
sudo chmod -R 775 /var/www/startuphub/bootstrap/cache
```

### 8. Environment Variables

```bash
cd /var/www/startuphub
sudo -u startuphub cp .env.example .env
sudo -u startuphub nano .env

# Configure:
APP_ENV=production
APP_DEBUG=false
DB_HOST=localhost
DB_DATABASE=startuphub_prod
DB_USERNAME=startuphub_user
DB_PASSWORD=<strong-password>
# ... other variables
```

### 9. Application Setup

```bash
cd /var/www/startuphub
sudo -u startuphub php artisan key:generate --force
sudo -u startuphub php artisan migrate --force
sudo -u startuphub php artisan config:cache
sudo -u startuphub php artisan route:cache
sudo -u startuphub php artisan view:cache
```

## Post-Deployment

### 1. Verification
- [ ] Test API endpoints
- [ ] Check SSL certificate
- [ ] Verify database connection
- [ ] Test queue processing
- [ ] Monitor logs for errors

### 2. Monitoring Setup
- [ ] Configure monitoring (Sentry, DataDog)
- [ ] Set up alerting
- [ ] Enable access logging
- [ ] Configure uptime monitoring

### 3. Backup Configuration
- [ ] Automated daily backups
- [ ] Test backup restoration
- [ ] Verify backup storage
- [ ] Document recovery procedure

### 4. Performance Optimization
- [ ] Enable Redis caching
- [ ] Configure CDN if applicable
- [ ] Optimize images
- [ ] Minify assets

## Maintenance

### Regular Tasks

#### Daily
- Monitor error logs
- Check server resource usage
- Review queue status

#### Weekly
- Review security logs
- Test backups
- Update composer/npm dependencies

#### Monthly
- Security audit
- Performance review
- Database optimization

#### Quarterly
- SSL certificate verification
- Disaster recovery drill
- Security penetration testing

## Scaling

### Database Scaling
- Implement connection pooling (PgBouncer)
- Add read replicas for read-heavy operations
- Implement database partitioning

### Cache Scaling
- Implement Redis cluster
- Use separate Redis instances for different purposes
- Monitor cache hit rates

### Application Scaling
- Use load balancer (HAProxy, Nginx)
- Horizontal scaling with multiple servers
- Use container orchestration (Docker, Kubernetes)

## Troubleshooting

### Common Issues

#### Database Connection Error
```bash
# Check PostgreSQL service
sudo systemctl status postgresql

# Check PHP connection
php -r "var_dump(pg_connect('host=localhost dbname=startuphub_prod user=startuphub_user password=...'))"
```

#### Queue Not Processing
```bash
# Check supervisor status
sudo supervisorctl status

# Restart workers
sudo supervisorctl restart startuphub-worker:*

# Check queue size
php artisan queue:failed
```

#### High Memory Usage
```bash
# Monitor processes
top -u startuphub

# Optimize Laravel
php artisan optimize:clear
php artisan config:clear
```

## Rollback Procedure

```bash
# Revert to previous version
cd /var/www/startuphub
git revert --no-edit <commit-hash>
composer install --no-dev
npm install && npm run build

# Migrate database down (if needed)
php artisan migrate:rollback --step=1

# Clear caches
php artisan cache:clear
```
