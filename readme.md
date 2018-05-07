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
php artisan config:cache
php artisan vendor:publish --provider="Laracrumbs\ServiceProvider" --tag=config
composer dump-autoload
php artisan migrate --path=vendor/blackdrago/laracrumbs/src/database/migrations/
```

Create a file called **routes/laracrumbs.php** and define the application's Laracrumbs. (See below.)

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

For example, assume there are two models: Category and Product. There are also two corresponding 'detail view' routes. Registering them will look like this:
```php
Laracrumbs::register([
    'route_name' => 'category-view',
    'map' => 'category_laracrumb'
]);
Laracrumbs::register([
    'route_name' => 'product-view',
    'map' => 'product_laracrumb'
]);
```

If it's preferred, a function from within a class can be utilized instead:
```php
Laracrumbs::register([
    'route_name' => 'category-view',
    'map' => '\App\Models\Category::laracrumb'
]);
Laracrumbs::register([
    'route_name' => 'product-view',
    'map' => '\App\Models\Product::laracrumb'
]);
```

Example of a complex Laracrumb mapping function for a Category model, which has Home as a parent:
```php
function category_laracrumb($route, $link)
{
    $params = $route->parameters();
    $category = \App\Models\Category::find((int)($params['id']));
    if (!is_null($category)) {
        $laracrumb = new \Laracrumbs\Models\Laracrumb();
        $laracrumb->link = $link;
        $laracrumb->display_text = $category->name;
        $laracrumb->parent_id = \Laracrumbs::findParentId('home');
        $laracrumb->save();
        return $laracrumb;
    }
    return null;
}
```

Another example, for a Product model. It's parent is a Category specified by $product->category_id.
```php
function product_laracrumb($route, $link)
{
    $params = $route->parameters();
    $product = \App\Models\Product::find((int)($params['id']));
    if (!is_null($product)) {
        $laracrumb = new \Laracrumbs\Models\Laracrumb();
        $laracrumb->link = $link;
        $laracrumb->display_text = $product->name;
        $laracrumb->parent_id = \Laracrumbs::findParentId('category-view', ['id' => $product->category_id]);
        $laracrumb->save();
        return $laracrumb;
    }
    return null;
}
```

## 3.3 Create a non-link Laracrumb
A non-link laracrumb does not have a route or a link associated with it, but rather serves as a marker or category. 

Example of non-link Laracrumb:
```php
Laracrumbs::register([
    'display_text' => 'Getting Started',
]);
Laracrumbs::register([
    'display_text' => 'Markup Tutorial',
    'parent_id' => Laracrumbs::findParentIdByDisplayText('Getting Started')
]);
```
