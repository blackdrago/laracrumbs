# Laracrumbs
A database-driven breadcrumbs package for Laravel.

# 1 Requirements
- Laravel 5.6 (not tested with Laravel 5.0 to Laravel 5.5)
- Laravel Mix

# 2 Installation
## 2.1 Install by Composer
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

## 2.2 Configuration
Laracrumbs have several configuration settings, including:

- translation_key: a package prefix for translating language key values
- template: the name of the Blade template to use for breadcrumbs
- absolute_paths: boolean flag that indicates if absolute paths are used for routes

# 3 Creating Laracrumbs
There are three kinds of Laracrumbs:

1. **Basic**: A breadcrumb for a link or a route with no parameters.
2. **Complex**: A breadcrumb for a route with at least one parameter.
3. **Non-link**: A breadcrumb that serves as a category or marker but has no link.

## 3.1 Create a basic Laracrumb
A basic Laracrumb can be for a link or a route with no parameters.

Routes:
```php
Laracrumbs::register([
    'link' => route('home'),
    'display_text' => 'Home',
]);
Laracrumbs::register([
    'link' => route('browse'),
    'display_text' => 'Browse',
    'parent_id' => Laracrumb::findByLink(route('home'))->parent_id
]);
```

Links:
```php
Laracrumbs::register([
    'link' => 'http://www.example.com',
    'display_text' => 'Grandparent site',
]);
Laracrumbs::register([
    'link' => 'http://www.anotherexample.com',
    'display_text' => 'Parent site',
    'parent_id' => Laracrumb::findByLink('http://www.example.com')->parent_id
]);
```

## 3.2 Create a complex Laracrumb
Routes with parameters require complex Laracrumbs. Since a route with at least one parameter can produce multiple URLs, complex Laracrumbs require a mapping function.

*Example of Laracrumb mapping coming soon.*

## 3.3 Create a non-link Laracrumb
A non-link laracrumb does not have a route or a link associated with it, but rather serves as a marker or category. 

Example of non-link Laracrumb:
```php
Laracrumbs::register([
    'display_text' => 'Getting Started',
]);
Laracrumbs::register([
    'display_text' => 'Markup Tutorial',
    'parent_id' => Laracrumb::findByLink('Getting Started')->parent_id
]);
```
