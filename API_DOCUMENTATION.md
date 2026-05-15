# API Documentation

## Base URL
```
https://api.startuphub.com/api/v1
```

## Authentication
All API requests (except `/auth/register` and `/auth/login`) require Bearer token authentication.

### Headers
```
Authorization: Bearer {token}
Content-Type: application/json
```

## Authentication Endpoints

### Register User
```
POST /auth/register
```

**Body:**
```json
{
  "email": "user@example.com",
  "password": "password123",
  "password_confirmation": "password123",
  "first_name": "John",
  "last_name": "Doe",
  "role": "founder|investor|job_seeker|partner"
}
```

**Response:**
```json
{
  "success": true,
  "message": "User registered successfully",
  "user": {
    "id": "uuid",
    "email": "user@example.com",
    "first_name": "John",
    "last_name": "Doe",
    "role": "founder"
  },
  "token": "sanctum-token"
}
```

### Login
```
POST /auth/login
```

**Body:**
```json
{
  "email": "user@example.com",
  "password": "password123"
}
```

**Response:**
```json
{
  "success": true,
  "message": "Login successful",
  "user": {
    "id": "uuid",
    "email": "user@example.com",
    "first_name": "John",
    "last_name": "Doe",
    "role": "founder"
  },
  "token": "sanctum-token"
}
```

### Logout
```
POST /auth/logout
Authorization: Bearer {token}
```

### Get Current User
```
GET /auth/me
Authorization: Bearer {token}
```

## Startup Endpoints

### List All Startups
```
GET /startups?industry=tech&stage=seed&country=US&search=keyword&is_hiring=true
```

**Query Parameters:**
- `industry` (string, optional): Filter by industry
- `stage` (string, optional): Filter by funding stage
- `country` (string, optional): Filter by country
- `search` (string, optional): Search by name/description
- `is_hiring` (boolean, optional): Filter hiring startups

**Response:**
```json
{
  "success": true,
  "data": {
    "data": [...],
    "current_page": 1,
    "total": 100,
    "per_page": 20
  }
}
```

### Get Startup Details
```
GET /startups/{id}
```

### Create Startup (Founder/Admin only)
```
POST /startups
Authorization: Bearer {token}
```

**Body:**
```json
{
  "name": "TechStartup Inc",
  "description": "A revolutionary tech startup...",
  "short_description": "Revolutionizing tech",
  "industry": "Technology",
  "stage": "seed",
  "website_url": "https://techstartup.com",
  "founded_at": "2024-01-15",
  "country": "US",
  "city": "San Francisco",
  "visibility": "public"
}
```

### Update Startup (Owner/Admin only)
```
PATCH /startups/{id}
Authorization: Bearer {token}
```

### Get Startup Statistics
```
GET /startups/{id}/stats
Authorization: Bearer {token}
```

## Job Endpoints

### List All Jobs
```
GET /jobs?job_type=full_time&experience_level=mid&remote_type=remote&search=keyword
```

### Get Job Details
```
GET /jobs/{id}
```

### Create Job (Founder/Admin only)
```
POST /jobs
Authorization: Bearer {token}
```

**Body:**
```json
{
  "title": "Senior Backend Engineer",
  "description": "We are looking for a senior backend engineer...",
  "requirements": "5+ years experience with Node.js",
  "benefits": "Competitive salary, equity",
  "job_type": "full_time",
  "experience_level": "senior",
  "salary_min": 100000,
  "salary_max": 150000,
  "location": "San Francisco",
  "remote_type": "hybrid",
  "skills_required": ["Node.js", "PostgreSQL", "React"]
}
```

### Apply for Job (Job Seeker only)
```
POST /jobs/{id}/apply
Authorization: Bearer {token}
```

**Body:**
```json
{
  "resume_url": "https://example.com/resume.pdf",
  "cover_letter": "I am interested in this position because...",
  "portfolio_url": "https://portfolio.example.com"
}
```

### Get Job Applications (Founder/Admin only)
```
GET /jobs/{id}/applications
Authorization: Bearer {token}
```

## Investor Endpoints

### Get Investor Profile
```
GET /investor/profile
Authorization: Bearer {token}
```

### Update Investor Profile
```
PATCH /investor/profile
Authorization: Bearer {token}
```

**Body:**
```json
{
  "company_name": "Venture Capital Inc",
  "company_description": "We invest in early-stage startups",
  "investment_range_min": 100000,
  "investment_range_max": 1000000,
  "industries": ["Technology", "Healthcare"],
  "stages": ["seed", "series_a"],
  "countries": ["US", "Canada"],
  "website_url": "https://vc.example.com"
}
```

### Get Watchlist
```
GET /investor/watchlist
Authorization: Bearer {token}
```

### Add to Watchlist
```
POST /investor/watchlist/{startup_id}
Authorization: Bearer {token}
```

### Remove from Watchlist
```
DELETE /investor/watchlist/{startup_id}
Authorization: Bearer {token}
```

### Get Investments
```
GET /investor/investments
Authorization: Bearer {token}
```

### Create Investment
```
POST /investor/investments/{startup_id}
Authorization: Bearer {token}
```

**Body:**
```json
{
  "amount": 500000,
  "investment_type": "seed",
  "equity_percentage": 5
}
```

## Message Endpoints

### Get Conversations
```
GET /messages
Authorization: Bearer {token}
```

### Get Conversation with User
```
GET /messages/{user_id}
Authorization: Bearer {token}
```

### Send Message
```
POST /messages/{user_id}
Authorization: Bearer {token}
```

**Body:**
```json
{
  "content": "Hello, I'm interested in your startup..."
}
```

### Mark Message as Read
```
PATCH /messages/{id}/read
Authorization: Bearer {token}
```

### Get Unread Count
```
GET /messages/unread/count
Authorization: Bearer {token}
```

## Error Responses

### Authentication Error
```json
{
  "success": false,
  "message": "Unauthenticated. Please provide a valid token."
}
```
**Status Code:** 401

### Authorization Error
```json
{
  "success": false,
  "message": "Unauthorized. You do not have permission to perform this action."
}
```
**Status Code:** 403

### Validation Error
```json
{
  "success": false,
  "message": "Validation failed",
  "errors": {
    "email": ["The email field is required"],
    "password": ["The password must be at least 8 characters"]
  }
}
```
**Status Code:** 422

### Not Found Error
```json
{
  "success": false,
  "message": "Resource not found"
}
```
**Status Code:** 404

### Server Error
```json
{
  "success": false,
  "message": "An error occurred. Please try again."
}
```
**Status Code:** 500

## Rate Limiting

API endpoints are rate-limited to prevent abuse:
- 60 requests per minute for authenticated users
- 20 requests per minute for unauthenticated endpoints

Rate limit information is included in response headers:
- `X-RateLimit-Limit`: Maximum requests allowed
- `X-RateLimit-Remaining`: Requests remaining
- `X-RateLimit-Reset`: Unix timestamp when limit resets

## Pagination

List endpoints return paginated results:
- Default: 20 items per page
- Max: 100 items per page

**Query Parameters:**
- `page` (integer, optional): Page number (default: 1)
- `per_page` (integer, optional): Items per page (default: 20, max: 100)

**Response:**
```json
{
  "success": true,
  "data": {
    "data": [...],
    "current_page": 1,
    "first_page_url": "https://api.startuphub.com/api/v1/startups?page=1",
    "from": 1,
    "last_page": 5,
    "last_page_url": "https://api.startuphub.com/api/v1/startups?page=5",
    "next_page_url": "https://api.startuphub.com/api/v1/startups?page=2",
    "path": "https://api.startuphub.com/api/v1/startups",
    "per_page": 20,
    "prev_page_url": null,
    "to": 20,
    "total": 100
  }
}
```
