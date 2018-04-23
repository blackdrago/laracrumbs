# Laracrumbs
A database-driven breadcrumbs package for Laravel.

# Requirements
- Laravel 5.6 (not tested with Laravel 5.0 to Laravel 5.5)
- Laravel Mix

# Installation
Install via composer:
```
composer require blackdrago/laracrumbs
```

Then edit the application's config/app.php file and add this to the $providers array:
```php
   Laracrumbs\ServiceProvider::class,
```

Run the following commands:
```
php artisan vendor:publish --provider=Laracrumbs\ServiceProvider --force
```

# Configuration
