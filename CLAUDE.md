# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

This is a Laravel 12 application named "coffeeblend" running on XAMPP with:
- PHP 8.2+
- Laravel Framework 12.0
- Vite for asset bundling
- Tailwind CSS 4.0
- SQLite database (default)

## Development Commands

### Initial Setup
```bash
composer setup
```
This installs dependencies, creates .env, generates app key, runs migrations, and builds assets.

### Running the Application
```bash
composer dev
```
This command runs four concurrent processes:
- Laravel development server (`php artisan serve`)
- Queue worker (`php artisan queue:listen --tries=1`)
- Log viewer with Pail (`php artisan pail --timeout=0`)
- Vite dev server (`npm run dev`)

### Alternative: Individual Services
```bash
php artisan serve              # Start dev server (http://localhost:8000)
npm run dev                    # Run Vite dev server with hot reload
php artisan queue:listen       # Start queue worker
php artisan pail               # View logs in real-time
```

### Testing
```bash
composer test                  # Run all tests (clears config first)
php artisan test              # Run PHPUnit tests directly
php artisan test --filter=ExampleTest  # Run specific test
```

PHPUnit is configured with:
- Unit tests: `tests/Unit/`
- Feature tests: `tests/Feature/`
- Test environment uses SQLite in-memory database

### Code Quality
```bash
vendor/bin/pint               # Run Laravel Pint for code style fixes
```

### Database
```bash
php artisan migrate           # Run migrations
php artisan migrate:fresh     # Drop all tables and re-run migrations
php artisan migrate:fresh --seed  # Fresh migration with seeders
php artisan db:seed           # Run database seeders
```

Default database is SQLite. Database file location: `database/database.sqlite`

### Asset Building
```bash
npm run dev                   # Development build with hot reload
npm run build                 # Production build
```

Assets are compiled from:
- `resources/css/app.css`
- `resources/js/app.js`

## Architecture

### Directory Structure
- `app/Http/Controllers/` - Request handling
- `app/Models/` - Eloquent models
- `app/Providers/` - Service providers
- `config/` - Configuration files
- `database/migrations/` - Database migrations
- `database/seeders/` - Database seeders
- `database/factories/` - Model factories for testing
- `routes/web.php` - Web routes
- `routes/console.php` - Artisan commands
- `resources/views/` - Blade templates
- `resources/css/` - Stylesheets
- `resources/js/` - JavaScript files
- `tests/` - PHPUnit tests

### PSR-4 Autoloading
- `App\` → `app/`
- `Database\Factories\` → `database/factories/`
- `Database\Seeders\` → `database/seeders/`
- `Tests\` → `tests/`

### Default Stack
- Frontend: Vite + Tailwind CSS 4.0
- Queue: Database driver (default)
- Cache: Database driver (default)
- Session: Database driver
- Mail: Log driver (development)

## Environment Configuration

Copy `.env.example` to `.env` for local configuration. Key settings:
- `APP_KEY` - Generate with `php artisan key:generate`
- `DB_CONNECTION` - Default is `sqlite`
- `QUEUE_CONNECTION` - Default is `database`
- `CACHE_STORE` - Default is `database`

## Running on XAMPP

This project is currently deployed in XAMPP at `/Applications/XAMPP/xamppfiles/htdocs/coffeeblend/`