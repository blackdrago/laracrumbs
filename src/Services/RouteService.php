<?php
/**
 * Contains the RouteService class.
 *
 * @package Laracrumbs\Services
 */
namespace Laracrumbs\Services;

use Illuminate\Routing\Route;
use Laracrumbs\Models\Laracrumb;

/**
 * RouteServices encapsulates business logic for route-related methods.
 */
class RouteService
{
    /**
     * Given a route, return its full link.
     *
     * @param  \Illuminate\Routing\Route $route
     * @return string
     */
    public static function getLink($route)
    {
        return route(
            $route->getName(),
            $route->parameters(),
            config('laracrumbs.absolute_paths')
        );
    }

    /**
     * Given a name and optional parameters, return the full URL.
     *
     * @param  string $routeName
     * @param  array  $parameters  (optional)
     * @return string
     */
    public static function getURL($routeName, $parameters = [])
    {
        return route($routeName, $parameters, config('laracrumbs.absolute_paths'));
    }
}
