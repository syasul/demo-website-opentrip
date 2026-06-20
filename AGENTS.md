# AI Agent Instructions for Demo-Website-OpenTrip

This repository is a Laravel 13+ application for a travel booking website with public pages, user dashboard, and admin panel.

## What the project is
- A Laravel web application built with PHP 8.3.
- Uses Blade templates in `resources/views` and Vite for frontend assets.
- Includes separate user and admin authentication flows.
- Stores domain models in `app/Models` and controllers in `app/Http/Controllers`.

## Key files and directories
- `routes/web.php` — primary HTTP route definitions, including public routes, auth, user dashboard, and admin panel.
- `app/Http/Controllers/VisitorController.php` — public visitor-facing pages.
- `app/Http/Controllers/AuthController.php` — login/register/logout flows.
- `app/Http/Controllers/UserDashboardController.php` — authenticated user actions, booking, payments, profile, reviews.
- `app/Http/Controllers/AdminDashboardController.php` — admin management of trips, bookings, users, reviews, articles.
- `resources/views/` — Blade templates for public pages, dashboard, and admin UI.
- `app/Models/` — domain models such as `Trip`, `Booking`, `Payment`, `Review`, `Article`, `User`, `Admin`.
- `database/migrations/` — schema for users, admins, trips, bookings, payments, reviews, articles, and related tables.
- `composer.json` / `package.json` — install, dev, build, and test scripts.

## Build and test commands
Use the project scripts before editing or testing:
- `composer install`
- `npm install`
- `composer setup` — installs PHP dependencies, copies env, generates key, migrates, installs npm deps, and builds assets.
- `npm run dev` — starts Vite development server.
- `composer run dev` — starts Laravel server, queue listener, pail, and Vite concurrently.
- `composer test` — runs `php artisan test`.
- `npm run build` — builds frontend assets.

## Style and behavior guidance
- Follow Laravel MVC conventions: keep HTTP handling in controllers, business rules in models/services, and presentation in Blade views.
- Use existing controllers/routes for public, user, and admin actions rather than introducing unrelated new endpoints.
- Keep Blade syntax idiomatic and avoid injecting raw HTML or inline scripts when existing layout structure can be reused.
- When modifying auth or dashboard behavior, ensure both `auth:web` and `auth:admin` middleware are respected.

## Notes for AI agents
- Do not assume this is a plain PHP site; it is a Laravel app with built-in routing, middleware, and a Vite asset pipeline.
- For database-related work, prefer the existing migrations and Eloquent models rather than creating new storage abstractions.
- If you need deeper behavior or documentation, check `README.md` and the Laravel docs linked there.
- Keep changes minimal and consistent with the existing route names, controller actions, and admin/user separation.
