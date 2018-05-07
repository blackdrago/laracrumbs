<?php
/**
 * Contains the Composer class.
 *
 * @package Laracrumbs
 * @author  K. McCormick <kyliemccormick@gmail.com>
 */
namespace Laracrumbs;

use Laracrumbs\Models\Laracrumb;
use Laracrumbs\Models\LaracrumbMap;
use Laracrumbs\Services\RouteService;
use Laracrumbs\Services\UtilityService;

/**
 * Composer handles the UI elements of Laracrumbs.
 */
class Composer
{
    /**
     * Return the rendered Laracrumb,
     *
     * @param  \Laracrumbs\Models\Laracrumb
     * @return \Illuminate\Http\Response
     */
    public static function render($laracrumb)
    {
        return view(config('laracrumbs.template'), ['laracrumb' => $laracrumb]);
    }

    /**
     * Find a Laracrumb given the route name and route parameters. If no Laracrumb 
     * can be found, try to create it.
     *
     * @param  string                            $routeName
     * @param  array                             $params      (optional)
     * @return \Laracrumbs\Models\Laracrumb|null
     */
    public static function findOrCreate($routeName, $params = [])
    {
        $route = \Route::getRoutes()->getByName($routeName);
        $route->parameters = $params;
        return self::findOrCreateByRoute($route);
    }

    /**
     * Find a Laracrumb given its full URL and its Route object. If none is found,
     * try to create it.
     *
     * @param  \Illuminate\Routing\Route        $route
     * @return \Laracrumbs\Models\Laracrumb|null
     */
    public static function findOrCreateByRoute($route)
    {
        $link = RouteService::getLink($route);
        $laracrumb = Laracrumb::findByLink($link);
        if (is_null($laracrumb)) {
            return self::createLaracrumb($route, $link, true);
        }
        return $laracrumb;
    }

    /**
     * Create a new Laracrumb for a route and its associated link.
     *
     * @param  \Illuminate\Routing\Route        $route
     * @param  string                           $link
     * @return \Laracrumbs\Models\Laracrumb|null
     */
    public static function createLaracrumb($route, $link)
    {
        $mapper = LaracrumbMap::where('route_name', '=', $route->getName())->first();
        if (!is_null($mapper) && UtilityService::mappedFunctionExists($mapper->function_name)) {
            $funcName = $mapper->function_name;
            return $funcName($route, $link);
        }
        return null;
    }

    /**
     * Create a new Laracrumb.
     *
     * @param array $settings
     */
    public static function create($settings)
    {
        $crumb = new Laracrumb();
        foreach ($settings as $attr => $value) {
            $crumb->$attr = $value;
        }
        $crumb->save();
    }

    /**
     * Create a new Laracrumb Map.
     *
     * @param string $routeName
     * @param string $funcName
     */
    public static function createMap($routeName, $funcName)
    {
        $map = new LaracrumbMap();
        $map->route_name = $routeName;
        $map->function_name = $funcName;
        $map->save();
    }
}
