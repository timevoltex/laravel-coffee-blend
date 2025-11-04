# Repository Guidelines

## Project Structure & Module Organization
Laravel domain logic resides in `app/`, with controllers under `app/Http/Controllers`, Eloquent models in `app/Models`, and jobs/events supporting background workflows. Frontend assets live in `resources/js` (React/Vite entry points) and `resources/css|sass` (Tailwind and Bootstrap overrides), while Blade scaffolding sits in `resources/views`. HTTP routes are split between `routes/web.php` for rendered pages and `routes/api.php` for JSON endpoints. Schema changes belong in `database/migrations`, reusable factories in `database/factories`, and seeders in `database/seeders`. Built assets are published to `public/`; keep `storage/` writable for logs and cached files.

## Build, Test, and Development Commands
- `composer setup` — one-step bootstrap: installs dependencies, copies `.env`, runs migrations, and builds assets.
- `composer dev` — launches the Laravel server, queue listener, Pail log viewer, and Vite dev server together.
- `php artisan serve` and `npm run dev` — run backend and frontend separately when you need focused debugging.
- `npm run build` — produce production-ready JS/CSS into `public/build`.
- `composer test` (or `php artisan test`) — clear config cache and execute the full PHPUnit suite.

## Coding Style & Naming Conventions
Adhere to PSR-12 with 4-space indentation for PHP; run `./vendor/bin/pint` before committing to keep formatting consistent. Controllers, jobs, and notifications use PascalCase (`OrderReportJob`), while service classes sit under feature-based namespaces (`App\Services\Orders`). React components in `resources/js` should use PascalCase filenames (e.g., `AdminDashboard.tsx`), export named components, and colocate feature styles. Favor Tailwind utility classes; when extracting custom styles, follow kebab-case file names inside `resources/css`. Keep Blade templates slim and push business logic to view models or controllers.

## Testing Guidelines
PHPUnit is configured via `phpunit.xml`; place feature tests in `tests/Feature` and unit-level coverage in `tests/Unit`, naming files with the `*Test.php` suffix. Use database factories and the `RefreshDatabase` trait to isolate state. Aim for meaningful assertions around order workflows, bookings, and payments, and target at least the coverage exercised by existing scenarios. Run selective suites with `php artisan test --testsuite=Feature` when iterating, and `php artisan test --coverage` before opening a pull request if Xdebug is available.

## Commit & Pull Request Guidelines
Follow the existing short, imperative summaries seen in `git log` (e.g., `Admin 대시보드 통계 및 관리자 관리 기능 구현`). Group related changes per commit, and include context in English or Korean as long as the intent is clear. Pull requests should describe the problem, outline the solution, list any migrations or breaking changes, and attach screenshots for UI updates. Reference related issues with `Fixes #123` and ensure CI (composer test/build) passes before requesting review.
