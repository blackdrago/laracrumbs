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

    /**
     * Check if the given route has a laracrumb.
     *
     * @param  \Illuminate\Routing\Route $route
     * @return boolean
     */
    public static function hasLaracrumb(Route $route)
    {
        $identifier = self::getIdentifier($route);
        $laracrumb = Laracrumb::where('route_identifier', '=', $identifier)->first();
        return !is_null($laracrumb);
    }

    /**
     * Get a (semi)unique identifier for the given route.
     *
     * @param  \Illuminate\Routing\Route $route
     * @return string
     */
    public static function getIdentifier(Route $route)
    {
        if (!empty($route->getName())) {
            // use name to identify this route
            return $route->getName() . '_' . self::flattenMethods($route->methods());
        }
        // create another unique identifier
        return $route->uri() . '_' 
            . $route->getActionName() . '_'
            . self::flattenMethods($route->methods());
    }

    /**
     * Given an array of methods, flatten them into a string.
     *
     * @param  array  $methods
     * @param  string $glue    (optional) defaults to comma (-)
     * @return string
     */
    public static function flattenMethods($methods, $glue = '-')
    {
        return strtolower(implode($glue, $methods));
    }
}
