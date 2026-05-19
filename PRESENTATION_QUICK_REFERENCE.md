# 📊 QUICK REFERENCE GUIDE - StartupHub Platform

## ONE-PAGE PROJECT OVERVIEW

### Project Name
**StartupHub** - Premium Startup Ecosystem Platform

### What Does It Do?
Connects **Founders** (seeking capital/hiring), **Investors** (seeking opportunities), and **Job Seekers** (seeking startup jobs) in one platform.

---

## QUICK FACTS

| Item | Details |
|------|---------|
| **Framework** | Laravel 11 (PHP) |
| **Frontend** | Blade Templates + Tailwind CSS + Alpine.js |
| **Database** | MySQL with UUID keys |
| **Auth** | Laravel Sanctum + Sessions |
| **User Roles** | Founder, Investor, Job Seeker, Admin |
| **Pages** | 15+ fully functional pages |
| **API Endpoints** | 20+ RESTful endpoints |
| **Key Tables** | Users, Startups, Jobs, Investments, Applications |

---

## THE THREE MAIN USERS

### 👔 FOUNDER
**What they need:** Raise capital + Hire talent
**What they can do:**
- Create startup profile
- Post job openings
- Receive investments
- View investor profiles
- Track applications

### 💰 INVESTOR
**What they need:** Find good startups + Manage portfolio
**What they can do:**
- Browse startups
- Make investments ($1k-$10M)
- Build watchlist
- View portfolio
- Track returns

### 🎯 JOB SEEKER
**What they need:** Find startup jobs + Get hired
**What they can do:**
- Search jobs
- Apply to positions
- Track applications
- Build profile
- Connect with founders

---

## CORE FEATURES AT A GLANCE

```
DISCOVERY          → Browse startups, filter by industry/stage/location
INVESTMENTS        → Make investments (validate $1k-$10M range)
JOBS               → Post/apply for jobs, track applications
WATCHLIST          → Save favorite startups
PORTFOLIO          → View all investments made
NOTIFICATIONS      → Real-time alerts for opportunities
MESSAGING          → Direct communication between users
PROFILES           → Customizable user profiles (role-based)
ACTIVITY LOG       → Track all important actions
ADMIN DASHBOARD    → Platform management & monitoring
```

---

## DATABASE IN 30 SECONDS

```
Users Table
├─ id, email, password, role (founder/investor/seeker/admin)
├─ Can create Startups (if founder)
└─ Can make Investments (if investor)

Startups Table
├─ id, founder_id, name, description, industry, stage
├─ Has many Jobs
└─ Receives many Investments

Jobs Table
├─ id, startup_id, title, salary, location
└─ Receives many Applications

Investments Table
├─ id, user_id (investor), startup_id
├─ amount ($1k-$10M), type (seed/series_a/etc)
└─ Auto-adds to Watchlist

Watchlist Table
├─ user_id, startup_id
└─ Tracks favorite startups
```

---

## REQUEST-RESPONSE CYCLE (5 SECONDS)

```
1. User clicks link/submits form
2. Browser sends HTTP request
3. Laravel router matches URL to Controller
4. Controller fetches data from database
5. Blade template renders HTML with data
6. Browser displays page
```

---

## AUTHENTICATION FLOW

```
User enters email+password
    ↓
Backend queries: SELECT * FROM users WHERE email = ?
    ↓
Verify: password_verify(input, database_hash)
    ↓
✓ Match → Create session → Redirect /dashboard
✗ No match → Return to login with error
```

---

## INVESTMENT PROCESS (10 STEPS)

```
1. Investor logs in
2. Visits /discover
3. Filters startups (industry, stage)
4. Clicks startup card
5. Views full startup profile
6. Clicks "Invest Now"
7. Fills investment form (amount, type, equity %)
8. Submits form
9. Backend validates & creates record
10. Redirected to portfolio
```

---

## KEY PAGES

| Page | Route | Role | Purpose |
|------|-------|------|---------|
| Home | `/` | All | Landing page |
| Login | `/login` | Guest | Sign in |
| Register | `/register` | Guest | Create account |
| Dashboard | `/dashboard` | Auth | Role-based hub |
| Discover | `/discover` | All | Browse startups |
| Startup Profile | `/startups/{id}` | All | View details |
| Investment Form | `/startups/{id}/invest` | Investor | Make investment |
| Portfolio | `/portfolio` | Investor | View investments |
| Jobs | `/jobs` | All | Browse positions |
| Create Startup | `/startups/create` | Founder | List startup |
| Messages | `/messages` | Auth | Direct chat |
| Notifications | `/notifications` | Auth | View alerts |
| Settings | `/settings` | Auth | Preferences |

---

## VALIDATION RULES

### Investment Amount
```
- Minimum: $1,000
- Maximum: $10,000,000
- Type: numeric/decimal
```

### Investment Type
```
Valid: seed, series_a, series_b, series_c, venture, angel, strategic
```

### User Registration
```
- Email: unique, valid format
- Password: 8+ characters
- Name: required
- Role: founder/investor/seeker/admin
```

---

## COMMON QUESTIONS ANSWERED

**Q: Why UUID instead of integers?**
A: Security (can't guess IDs), privacy, looks professional

**Q: How is password stored?**
A: Hashed using bcrypt, never stored as plain text

**Q: Can founder also invest?**
A: Yes! Investor profile auto-created for all users

**Q: What if investment amount is invalid?**
A: Validation rejects it, shows error message to user

**Q: How does watchlist work?**
A: One-click save to favorites, persistent across sessions

---

## FILE STRUCTURE (KEY FOLDERS)

```
Laravel/
├── app/Models/                  ← Database models
├── app/Http/Controllers/        ← Business logic
├── routes/web.php               ← URL mappings
├── resources/views/             ← HTML templates
└── database/migrations/         ← Schema versioning
```

---

**Keep this handy for quick reference during presentations!**
