<?php
/**
 * Contains the Conductor class.
 *
 * @package Laracrumbs
 * @author  K. McCormick <kyliemccormick@gmail.com>
 */
namespace Laracrumbs;

use Laracrumbs\Services\RouteService;
use Laracrumbs\Services\UtilityService;
use Laracrumbs\Models\Laracrumb;
use Laracrumbs\Models\LaracrumbMap;

/**
 * Conductor coordinates all aspects of Laracrumbs.
 *
 * For UI-related management, please see the Composer class.
 */
class Conductor
{
    /**
     * Get the field value.
     *
     * @param \Laracrumbs\Models\Laracrumb $laracrumb
     * @param  string                       $field
     * @return string
     */
    public static function fieldValue($laracrumb, $field)
    {
        if (empty($laracrumb)) {
            return '';
        }
        return old($field, $laracrumb->$field);
    }

    /**
     * Render/display the laracrumbs for the given route.
     *
     * @return \Illuminate\Http\Response
     */
    public function render()
    {
        $route = \Route::getCurrentRoute();
        $link = RouteService::getLink($route);
        $laracrumb = Laracrumb::findByLink($link);
        if (is_null($laracrumb)) {
            // create new Laracrumb
            $laracrumb = self::createLaracrumb($route, $link);
            if (is_null($laracrumb)) {
                return '&nbsp;';
            }
        }
        return Composer::render($laracrumb);
    }

    /**
     * Create a new Laracrumb for a route.
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
}
