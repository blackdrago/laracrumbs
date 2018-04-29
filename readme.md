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

Then edit the application's config/app.php file and add the following:
```php
    'providers' => [
        // ...
        Laracrumbs\ServiceProvider::class,
        // ...
    ],

    // ...

    'aliases' => [
        // ...
        'Laracrumbs' => Laracrumbs\Facades\Laracrumbs::class,
        // ...
    ],
```

Run the following commands:
```
php artisan vendor:publish --provider="Laracrumbs\ServiceProvider" --force
php artisan migrate --path=vendor/blackdrago/laracrumbs/src/database/migrations/
```

# Configuration
Laracrumbs have several configuration settings, including:

- translation_key: a package prefix for translating language key values
- template: the name of the Blade template to use for breadcrumbs
