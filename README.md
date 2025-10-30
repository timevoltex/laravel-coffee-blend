# Coffee Blend - Coffee Shop Management System

A comprehensive coffee shop management system built with Laravel 12, featuring a modern frontend with Tailwind CSS and a complete e-commerce solution for coffee shop operations.

This project is based on the Udemy course: [PHP & Laravel - Build Coffee Shop Management System](https://www.udemy.com/course/php-laravel-2023-build-coffee-shop-management-system/)

## Features

### Customer Features
- **User Authentication**: Secure registration and login system
- **Product Catalog**: Browse coffee products with detailed information
- **Shopping Cart**: Add products to cart and manage quantities
- **Checkout & Payment**: Complete checkout process with PayPal integration
- **Order Tracking**: View order history and status
- **Table Reservations**: Book tables for dining
- **Product Reviews**: Write and submit reviews for products
- **Menu**: View the complete coffee shop menu

### Admin Features
- **Admin Dashboard**: Comprehensive statistics and management overview
- **Admin Management**: Create and manage admin users
- **Secure Admin Panel**: Protected with authentication middleware
- **Order Management**: View and manage customer orders
- **Booking Management**: Handle table reservations
- **Review Moderation**: Monitor customer reviews

### Static Pages
- Home
- Services
- About
- Contact

## Tech Stack

### Backend
- **PHP**: 8.2+
- **Laravel Framework**: 12.0
- **Database**: SQLite (configurable to MySQL/PostgreSQL)
- **Authentication**: Laravel UI
- **Queue System**: Database driver
- **Cache**: Database driver

### Frontend
- **CSS Framework**: Tailwind CSS 4.0 + Bootstrap 5
- **JavaScript**: Vite + React 19.2.0
- **Asset Bundling**: Vite 7.0
- **UI Components**: Popper.js

### Development Tools
- **Laravel Pint**: Code style formatting
- **Laravel Pail**: Real-time log viewer
- **PHPUnit**: Testing framework
- **Concurrently**: Run multiple dev servers

## Prerequisites

- PHP 8.2 or higher
- Composer
- Node.js and npm
- XAMPP (or similar PHP development environment)

## Installation

### Quick Setup (Recommended)

Run the automated setup command:

```bash
composer setup
```

This command will:
1. Install PHP dependencies
2. Create `.env` file from `.env.example`
3. Generate application key
4. Run database migrations
5. Install Node.js dependencies
6. Build frontend assets

### Manual Setup

1. **Clone the repository**
   ```bash
   git clone <repository-url>
   cd coffeeblend
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Install Node.js dependencies**
   ```bash
   npm install
   ```

4. **Environment setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Database setup**
   ```bash
   php artisan migrate
   php artisan db:seed  # Optional: seed with sample data
   ```

6. **Build assets**
   ```bash
   npm run build
   ```

## Running the Application

### Development Mode (All Services)

Run all development services concurrently:

```bash
composer dev
```

This starts:
- Laravel development server at `http://localhost:8000`
- Queue worker for background jobs
- Real-time log viewer (Pail)
- Vite dev server with hot module reload

### Individual Services

Run services separately if needed:

```bash
# Laravel development server
php artisan serve

# Vite development server (hot reload)
npm run dev

# Queue worker
php artisan queue:listen --tries=1

# Real-time logs
php artisan pail --timeout=0
```

## Database Structure

The application uses the following database tables:

- `users` - Customer accounts
- `admins` - Administrator accounts
- `orders` - Customer orders
- `bookings` - Table reservations
- `reviews` - Product reviews
- `cache` - Application cache
- `jobs` - Background job queue

## Routes

### Public Routes
- `/` - Homepage
- `/about` - About page
- `/services` - Services page
- `/contact` - Contact page
- `/menu` - Menu page
- `/products/products-single/{id}` - Product details

### User Routes (Authentication Required)
- `/cart` - Shopping cart
- `/checkout` - Checkout process
- `/users/orders` - Order history
- `/users/bookings` - Booking history
- `/users/write-review` - Write product reviews

### Admin Routes (Admin Authentication Required)
- `/admin/login` - Admin login
- `/admin/index` - Admin dashboard
- `/all-admins` - Manage administrators
- `/create-admins` - Create new admin users

## Testing

Run the test suite:

```bash
composer test
```

Or run PHPUnit directly:

```bash
php artisan test
php artisan test --filter=ExampleTest
```

Tests are located in:
- `tests/Unit/` - Unit tests
- `tests/Feature/` - Feature tests

## Code Style

Format code using Laravel Pint:

```bash
vendor/bin/pint
```

## Database Commands

```bash
# Run migrations
php artisan migrate

# Fresh migration (drops all tables)
php artisan migrate:fresh

# Fresh migration with seeders
php artisan migrate:fresh --seed

# Run seeders only
php artisan db:seed
```

## Asset Management

```bash
# Development build with hot reload
npm run dev

# Production build (optimized)
npm run build
```

## Project Structure

```
coffeeblend/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admins/          # Admin controllers
│   │   │   ├── Auth/            # Authentication controllers
│   │   │   ├── Products/        # Product controllers
│   │   │   └── Users/           # User controllers
│   │   └── Middleware/          # Custom middleware
│   └── Models/                  # Eloquent models
├── database/
│   ├── migrations/              # Database migrations
│   ├── seeders/                 # Database seeders
│   └── factories/               # Model factories
├── resources/
│   ├── css/                     # Stylesheets
│   ├── js/                      # JavaScript files
│   └── views/                   # Blade templates
│       ├── admins/              # Admin views
│       ├── auth/                # Authentication views
│       ├── pages/               # Static pages
│       ├── products/            # Product views
│       └── users/               # User views
├── routes/
│   ├── web.php                  # Web routes
│   └── console.php              # Console commands
└── tests/
    ├── Feature/                 # Feature tests
    └── Unit/                    # Unit tests
```

## Configuration

Key environment variables in `.env`:

```env
APP_NAME="Coffee Blend"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=sqlite
# For MySQL, use:
# DB_CONNECTION=mysql
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=coffeeblend
# DB_USERNAME=root
# DB_PASSWORD=

QUEUE_CONNECTION=database
CACHE_STORE=database
SESSION_DRIVER=database

# PayPal configuration
PAYPAL_CLIENT_ID=your_paypal_client_id
PAYPAL_SECRET=your_paypal_secret
PAYPAL_MODE=sandbox
```

## Security

- Admin routes are protected with `auth:admin` middleware
- User routes are protected with `auth:web` middleware
- Price verification middleware prevents checkout manipulation
- Authentication checks prevent unauthorized access

## Troubleshooting

### Database Issues
```bash
# Reset database
php artisan migrate:fresh

# Clear cache
php artisan cache:clear
php artisan config:clear
php artisan view:clear
```

### Asset Issues
```bash
# Rebuild assets
npm run build

# Clear and rebuild
rm -rf node_modules package-lock.json
npm install
npm run build
```

### Permission Issues (Linux/Mac)
```bash
chmod -R 775 storage bootstrap/cache
```

## Contributing

This is a learning project based on a Udemy course. Feel free to fork and experiment with your own modifications.

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Support

For course-specific questions, please refer to the [Udemy course](https://www.udemy.com/course/php-laravel-2023-build-coffee-shop-management-system/).

For Laravel framework documentation, visit [Laravel Documentation](https://laravel.com/docs).

## Acknowledgments

- Laravel Framework
- Udemy Course Instructor
- Coffee shop community
