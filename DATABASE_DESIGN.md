# StartupHub Database Architecture

## Database Design Overview

Production-grade relational database schema optimized for scalability, performance, and maintainability.

## Core Tables

### 1. Users Table
```sql
CREATE TABLE users (
    id UUID PRIMARY KEY,
    email VARCHAR(255) UNIQUE NOT NULL,
    phone VARCHAR(20),
    password_hash VARCHAR(255) NOT NULL,
    first_name VARCHAR(100) NOT NULL,
    last_name VARCHAR(100) NOT NULL,
    avatar_url TEXT,
    bio TEXT,
    role ENUM('admin', 'founder', 'investor', 'job_seeker', 'partner'),
    email_verified_at TIMESTAMP,
    two_factor_secret TEXT,
    two_factor_verified_at TIMESTAMP,
    last_login_at TIMESTAMP,
    login_attempts INT DEFAULT 0,
    locked_until TIMESTAMP,
    is_active BOOLEAN DEFAULT true,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP,
    deleted_at TIMESTAMP
);

CREATE INDEX idx_users_email ON users(email);
CREATE INDEX idx_users_role ON users(role);
CREATE INDEX idx_users_is_active ON users(is_active);
```

### 2. Startups Table
```sql
CREATE TABLE startups (
    id UUID PRIMARY KEY,
    founder_id UUID NOT NULL REFERENCES users(id) ON DELETE CASCADE,
    name VARCHAR(255) NOT NULL UNIQUE,
    slug VARCHAR(255) UNIQUE NOT NULL,
    logo_url TEXT,
    banner_url TEXT,
    description TEXT NOT NULL,
    short_description VARCHAR(500),
    website_url VARCHAR(255),
    founded_at DATE,
    industry VARCHAR(100) NOT NULL,
    sub_industry VARCHAR(100),
    country VARCHAR(100),
    city VARCHAR(100),
    stage ENUM('idea', 'pre_seed', 'seed', 'series_a', 'series_b', 'series_c', 'growth', 'exit'),
    funding_goal DECIMAL(15,2),
    total_raised DECIMAL(15,2) DEFAULT 0,
    team_size INT,
    is_hiring BOOLEAN DEFAULT false,
    is_verified BOOLEAN DEFAULT false,
    visibility ENUM('public', 'private', 'investors_only') DEFAULT 'public',
    view_count INT DEFAULT 0,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    deleted_at TIMESTAMP
);

CREATE INDEX idx_startups_founder_id ON startups(founder_id);
CREATE INDEX idx_startups_stage ON startups(stage);
CREATE INDEX idx_startups_industry ON startups(industry);
CREATE INDEX idx_startups_is_verified ON startups(is_verified);
CREATE INDEX idx_startups_is_hiring ON startups(is_hiring);
CREATE INDEX idx_startups_slug ON startups(slug);
```

### 3. Startup Profiles (Extended Details)
```sql
CREATE TABLE startup_profiles (
    id UUID PRIMARY KEY,
    startup_id UUID UNIQUE NOT NULL REFERENCES startups(id) ON DELETE CASCADE,
    pitch_deck_url TEXT,
    video_pitch_url TEXT,
    story TEXT,
    achievements TEXT,
    social_twitter VARCHAR(255),
    social_linkedin VARCHAR(255),
    social_github VARCHAR(255),
    social_instagram VARCHAR(255),
    monthly_revenue DECIMAL(15,2),
    mrr_growth_rate DECIMAL(5,2),
    active_users INT,
    customer_count INT,
    employees_count INT,
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);

CREATE INDEX idx_startup_profiles_startup_id ON startup_profiles(startup_id);
```

### 4. Team Members Table
```sql
CREATE TABLE startup_team_members (
    id UUID PRIMARY KEY,
    startup_id UUID NOT NULL REFERENCES startups(id) ON DELETE CASCADE,
    user_id UUID REFERENCES users(id) ON DELETE SET NULL,
    name VARCHAR(255) NOT NULL,
    position VARCHAR(255) NOT NULL,
    bio TEXT,
    avatar_url TEXT,
    email VARCHAR(255),
    linkedin_url TEXT,
    is_verified BOOLEAN DEFAULT false,
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);

CREATE INDEX idx_team_members_startup_id ON startup_team_members(startup_id);
CREATE INDEX idx_team_members_user_id ON startup_team_members(user_id);
```

### 5. Jobs Table
```sql
CREATE TABLE jobs (
    id UUID PRIMARY KEY,
    startup_id UUID NOT NULL REFERENCES startups(id) ON DELETE CASCADE,
    created_by_id UUID NOT NULL REFERENCES users(id) ON DELETE CASCADE,
    title VARCHAR(255) NOT NULL,
    slug VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    requirements TEXT,
    benefits TEXT,
    job_type ENUM('full_time', 'part_time', 'contract', 'internship'),
    experience_level ENUM('entry', 'junior', 'mid', 'senior'),
    salary_min DECIMAL(10,2),
    salary_max DECIMAL(10,2),
    salary_currency VARCHAR(3) DEFAULT 'USD',
    location VARCHAR(255),
    remote_type ENUM('remote', 'hybrid', 'onsite'),
    skills_required JSON,
    applications_count INT DEFAULT 0,
    is_active BOOLEAN DEFAULT true,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    closed_at TIMESTAMP,
    deleted_at TIMESTAMP
);

CREATE INDEX idx_jobs_startup_id ON jobs(startup_id);
CREATE INDEX idx_jobs_is_active ON jobs(is_active);
CREATE INDEX idx_jobs_job_type ON jobs(job_type);
CREATE INDEX idx_jobs_experience_level ON jobs(experience_level);
CREATE INDEX idx_jobs_remote_type ON jobs(remote_type);
```

### 6. Job Applications Table
```sql
CREATE TABLE job_applications (
    id UUID PRIMARY KEY,
    job_id UUID NOT NULL REFERENCES jobs(id) ON DELETE CASCADE,
    applicant_id UUID NOT NULL REFERENCES users(id) ON DELETE CASCADE,
    startup_id UUID NOT NULL REFERENCES startups(id) ON DELETE CASCADE,
    resume_url TEXT,
    cover_letter TEXT,
    portfolio_url TEXT,
    status ENUM('applied', 'viewed', 'shortlisted', 'rejected', 'accepted', 'withdrawn') DEFAULT 'applied',
    rating INT CHECK (rating >= 1 AND rating <= 5),
    notes TEXT,
    interviewed_at TIMESTAMP,
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);

CREATE INDEX idx_applications_job_id ON job_applications(job_id);
CREATE INDEX idx_applications_applicant_id ON job_applications(applicant_id);
CREATE INDEX idx_applications_status ON job_applications(status);
CREATE INDEX idx_applications_startup_id ON job_applications(startup_id);
CREATE UNIQUE INDEX idx_applications_unique ON job_applications(job_id, applicant_id);
```

### 7. Investor Profiles Table
```sql
CREATE TABLE investors (
    id UUID PRIMARY KEY,
    user_id UUID UNIQUE NOT NULL REFERENCES users(id) ON DELETE CASCADE,
    company_name VARCHAR(255),
    company_logo_url TEXT,
    company_description TEXT,
    investment_range_min DECIMAL(15,2),
    investment_range_max DECIMAL(15,2),
    industries JSON,
    stages JSON,
    countries JSON,
    portfolio_size INT,
    total_invested DECIMAL(15,2) DEFAULT 0,
    website_url VARCHAR(255),
    verified BOOLEAN DEFAULT false,
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);

CREATE INDEX idx_investors_user_id ON investors(user_id);
CREATE INDEX idx_investors_verified ON investors(verified);
```

### 8. Investments Table
```sql
CREATE TABLE investments (
    id UUID PRIMARY KEY,
    startup_id UUID NOT NULL REFERENCES startups(id) ON DELETE CASCADE,
    investor_id UUID NOT NULL REFERENCES investors(id) ON DELETE CASCADE,
    amount DECIMAL(15,2) NOT NULL,
    currency VARCHAR(3) DEFAULT 'USD',
    investment_type ENUM('seed', 'angel', 'venture', 'grant', 'revenue_share'),
    equity_percentage DECIMAL(5,2),
    status ENUM('proposed', 'negotiating', 'completed', 'failed') DEFAULT 'proposed',
    invested_at TIMESTAMP,
    notes TEXT,
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);

CREATE INDEX idx_investments_startup_id ON investments(startup_id);
CREATE INDEX idx_investments_investor_id ON investments(investor_id);
CREATE INDEX idx_investments_status ON investments(status);
```

### 9. Watchlist Table
```sql
CREATE TABLE watchlists (
    id UUID PRIMARY KEY,
    investor_id UUID NOT NULL REFERENCES investors(id) ON DELETE CASCADE,
    startup_id UUID NOT NULL REFERENCES startups(id) ON DELETE CASCADE,
    added_at TIMESTAMP,
    notes TEXT
);

CREATE INDEX idx_watchlists_investor_id ON watchlists(investor_id);
CREATE INDEX idx_watchlists_startup_id ON watchlists(startup_id);
CREATE UNIQUE INDEX idx_watchlists_unique ON watchlists(investor_id, startup_id);
```

### 10. Messages Table
```sql
CREATE TABLE messages (
    id UUID PRIMARY KEY,
    sender_id UUID NOT NULL REFERENCES users(id) ON DELETE CASCADE,
    recipient_id UUID NOT NULL REFERENCES users(id) ON DELETE CASCADE,
    content TEXT NOT NULL,
    read_at TIMESTAMP,
    created_at TIMESTAMP
);

CREATE INDEX idx_messages_sender_id ON messages(sender_id);
CREATE INDEX idx_messages_recipient_id ON messages(recipient_id);
CREATE INDEX idx_messages_created_at ON messages(created_at);
```

### 11. Notifications Table
```sql
CREATE TABLE notifications (
    id UUID PRIMARY KEY,
    user_id UUID NOT NULL REFERENCES users(id) ON DELETE CASCADE,
    type VARCHAR(100) NOT NULL,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    related_model VARCHAR(100),
    related_model_id UUID,
    read_at TIMESTAMP,
    created_at TIMESTAMP
);

CREATE INDEX idx_notifications_user_id ON notifications(user_id);
CREATE INDEX idx_notifications_read_at ON notifications(read_at);
```

### 12. Activity Logs Table
```sql
CREATE TABLE activity_logs (
    id UUID PRIMARY KEY,
    user_id UUID REFERENCES users(id) ON DELETE SET NULL,
    action VARCHAR(255) NOT NULL,
    model_type VARCHAR(100),
    model_id UUID,
    changes JSON,
    ip_address VARCHAR(45),
    user_agent TEXT,
    created_at TIMESTAMP
);

CREATE INDEX idx_activity_logs_user_id ON activity_logs(user_id);
CREATE INDEX idx_activity_logs_created_at ON activity_logs(created_at);
CREATE INDEX idx_activity_logs_action ON activity_logs(action);
```

### 13. Job Seeker Profiles Table
```sql
CREATE TABLE job_seeker_profiles (
    id UUID PRIMARY KEY,
    user_id UUID UNIQUE NOT NULL REFERENCES users(id) ON DELETE CASCADE,
    headline VARCHAR(255),
    bio TEXT,
    resume_url TEXT,
    portfolio_url TEXT,
    github_url VARCHAR(255),
    linkedin_url VARCHAR(255),
    twitter_url VARCHAR(255),
    years_experience INT,
    current_job_title VARCHAR(255),
    current_company VARCHAR(255),
    education JSON,
    skills JSON,
    certifications JSON,
    is_open_to_opportunities BOOLEAN DEFAULT true,
    preferred_job_types JSON,
    preferred_locations JSON,
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);

CREATE INDEX idx_job_seeker_profiles_user_id ON job_seeker_profiles(user_id);
```

### 14. User Skills Table
```sql
CREATE TABLE user_skills (
    id UUID PRIMARY KEY,
    user_id UUID NOT NULL REFERENCES users(id) ON DELETE CASCADE,
    skill_name VARCHAR(100) NOT NULL,
    proficiency_level ENUM('beginner', 'intermediate', 'advanced', 'expert'),
    years_of_experience INT,
    endorsements_count INT DEFAULT 0,
    created_at TIMESTAMP
);

CREATE INDEX idx_user_skills_user_id ON user_skills(user_id);
CREATE INDEX idx_user_skills_skill_name ON user_skills(skill_name);
```

## Key Design Decisions

1. **UUID Primary Keys**: Better for distributed systems and reduces ID guessing
2. **Soft Deletes**: Maintain data integrity with timestamp-based deletion
3. **Indexing Strategy**: Optimized for common queries and filtering
4. **Normalized Schema**: Reduces data redundancy, improves consistency
5. **Audit Trails**: Activity logs for compliance and debugging
6. **Role-based Design**: Flexible permission system
7. **Scalable Relationships**: Support growth without major refactoring

## Performance Optimizations

- Foreign key constraints for referential integrity
- Strategic indexing on frequently queried columns
- Denormalization where appropriate for read-heavy tables
- Partitioning strategy for large tables (future consideration)
- Query optimization through eager loading

## Security Measures

- Encrypted sensitive data (passwords, tokens)
- Soft delete protection
- Audit logging for compliance
- Row-level security considerations
- Data isolation by user/organization
