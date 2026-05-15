# Contributing Guide

## Code of Conduct

We are committed to providing a welcoming and inclusive environment. Please treat all contributors with respect.

## Getting Started

1. Fork the repository
2. Clone your fork
3. Create a feature branch
4. Make your changes
5. Submit a pull request

## Development Setup

```bash
# Clone repository
git clone https://github.com/yourusername/startup-hub.git
cd startup-hub

# Install dependencies
composer install
npm install

# Setup environment
cp .env.example .env
php artisan key:generate

# Setup database
createdb startup_hub_dev
php artisan migrate

# Start development server
php artisan serve
npm run watch
```

## Coding Standards

### PHP
- Follow PSR-12 coding standard
- Use type hints for all parameters and return types
- Write meaningful commit messages
- Keep functions small and focused

```php
<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\User;

class UserController
{
    public function index(Request $request): JsonResponse
    {
        // Implementation
    }

    private function validateUser(array $data): void
    {
        // Implementation
    }
}
```

### JavaScript/TypeScript
- Use ESLint configuration
- Follow naming conventions
- Use const/let instead of var
- Add JSDoc comments

```javascript
/**
 * Fetch startups from API
 * @param {Object} filters - Filter parameters
 * @returns {Promise<Array>} Array of startups
 */
const fetchStartups = async (filters = {}) => {
  // Implementation
};
```

### Database
- Write migrations for all schema changes
- Use meaningful table and column names
- Add proper indexes
- Include timestamps for audit

```php
Schema::create('startups', function (Blueprint $table) {
    $table->uuid('id')->primary();
    $table->string('name');
    $table->timestamps();
    $table->softDeletes();

    $table->index('name');
});
```

## Commit Message Guidelines

Use clear, descriptive commit messages:

```
feat: Add user authentication system
fix: Correct database connection issue
docs: Update API documentation
style: Format code according to PSR-12
refactor: Extract startup creation logic to service
test: Add tests for job application flow
chore: Update dependencies
```

Format: `type: description`

Types:
- `feat`: New feature
- `fix`: Bug fix
- `docs`: Documentation
- `style`: Code style changes
- `refactor`: Code refactoring
- `test`: Add/update tests
- `chore`: Maintenance

## Pull Request Process

1. **Create Branch**: Create feature branch from `main`
   ```bash
   git checkout -b feature/user-authentication
   ```

2. **Make Changes**: Implement feature with tests
   ```bash
   # Make changes
   git add .
   git commit -m "feat: Add user authentication"
   ```

3. **Test Locally**: Run all tests
   ```bash
   php artisan test
   npm run lint
   ```

4. **Push to GitHub**: Push branch to remote
   ```bash
   git push origin feature/user-authentication
   ```

5. **Create Pull Request**: Open PR with description
   - Title: Clear and descriptive
   - Description: Explain changes and why
   - Link related issues

6. **Code Review**: Address feedback from reviewers

7. **Merge**: Merge after approval

## Testing Requirements

### Unit Tests
```php
// tests/Unit/Models/StartupTest.php
public function test_startup_has_founder()
{
    $startup = Startup::factory()
        ->for(User::factory(), 'founder')
        ->create();

    $this->assertNotNull($startup->founder);
}
```

### Feature Tests
```php
// tests/Feature/Startup/CreateStartupTest.php
public function test_founder_can_create_startup()
{
    $user = User::factory()->create(['role' => 'founder']);

    $response = $this->actingAs($user)
        ->postJson('/api/v1/startups', [...]);

    $response->assertStatus(201);
}
```

**Requirements:**
- Add tests for new features
- Maintain 80%+ code coverage
- All tests must pass before PR merge
- Run: `php artisan test`

## Documentation

### Code Documentation
```php
/**
 * Create new startup
 *
 * @param CreateStartupRequest $request
 * @return JsonResponse
 * @throws AuthorizationException
 */
public function store(CreateStartupRequest $request): JsonResponse
{
    // Implementation
}
```

### API Documentation
Update API_DOCUMENTATION.md for new endpoints:
```markdown
### Create Startup
```
POST /api/v1/startups
```

**Authorization**: Bearer token (Founder/Admin only)

**Body**:
```json
{
  "name": "Startup Name",
  "description": "Description..."
}
```
```

### README
Update README.md if changing installation or setup process.

## Code Review Checklist

- [ ] Code follows PSR-12 standards
- [ ] All tests pass
- [ ] Code coverage maintained at 80%+
- [ ] No hardcoded values or credentials
- [ ] Appropriate error handling
- [ ] Documentation updated
- [ ] No breaking changes without discussion
- [ ] Performance considered

## Issue Reporting

### Bug Report Template
```markdown
## Description
Clear description of the bug

## Steps to Reproduce
1. Step 1
2. Step 2
3. Step 3

## Expected Behavior
What should happen

## Actual Behavior
What actually happens

## Environment
- PHP Version:
- Laravel Version:
- Database:
```

### Feature Request Template
```markdown
## Description
Clear description of the feature

## Motivation
Why is this feature needed?

## Proposed Solution
How should this feature work?

## Alternative Solutions
Other approaches considered
```

## Release Process

### Version Numbering
Follow semantic versioning: `MAJOR.MINOR.PATCH`

### Release Steps
1. Update version in `composer.json`
2. Update `CHANGELOG.md`
3. Create release branch: `release/v1.0.0`
4. Update documentation
5. Create GitHub release
6. Merge to main and develop

### Changelog Format
```markdown
## [1.0.0] - 2024-01-15
### Added
- New startup verification system
- Advanced job filtering

### Fixed
- Database connection pooling issue

### Changed
- Improved API response times

### Deprecated
- Old search endpoint

### Removed
- Legacy authentication method

### Security
- Updated dependencies for security patches
```

## Code Quality Tools

### Linting & Formatting
```bash
# PHP
./vendor/bin/pint              # Format PHP code
./vendor/bin/phpstan analyse   # Static analysis

# JavaScript
npm run lint                   # ESLint
npm run format                 # Prettier
```

### Pre-commit Hooks
```bash
# Install
npm install husky --save-dev
npx husky install

# Add hook
npx husky add .husky/pre-commit "npm run lint && php artisan test"
```

## Performance Considerations

- **Database**: Use eager loading, add indexes
- **Caching**: Cache frequent queries
- **API**: Paginate large result sets
- **Assets**: Minify CSS/JS, optimize images

## Security Considerations

- Never commit credentials or API keys
- Use environment variables for configuration
- Validate all user input
- Sanitize output to prevent XSS
- Use prepared statements for database queries
- Implement rate limiting on APIs

## Getting Help

- **Documentation**: Check `/docs` folder
- **Issues**: Search existing issues
- **Discussions**: Start a discussion on GitHub
- **Email**: Contact team@startuphub.com

## Recognition

Contributors will be recognized in:
- `CONTRIBUTORS.md` file
- Release notes
- Project website (if applicable)

Thank you for contributing to StartupHub! 🚀
