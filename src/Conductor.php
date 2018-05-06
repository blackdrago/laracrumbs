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
        $laracrumb = self::findOrCreate($route, $link);
        if (is_null($laracrumb)) {
            return '&nbsp;';
        }
        return Composer::render($laracrumb);
    }

    /**
     * Find and return the parent Laracrumb id.
     *
     * @param  string          $routeName
     * @param  array           $params     (optional)
     * @return integer|boolean
     */
    public static function findParentId($routeName, $params = [])
    {
       $url = RouteService::getURL($routeName, $params);
       $laracrumb = Laracumb::findByLink($url);
       if (is_null($laracrumb)) {
            $mapper = LaracrumbMap::where('route_name', '=', $routeName)->first();
            if (!is_null($mapper) && UtilityService::mappedFunctionExists($mapper->function_name)) {
                $funcName = $mapper->function_name;
                return $funcName($route, $link);
            } else {
                return false;
            }
       }
       return $laracrumb->id;
    }

    /**
     * Find a Laracrumb. If it doesn't exist, try to create it.
     *
     * @param  \Illuminate\Routing\Route        $route
     * @param  string                           $link
     * @return \Laracrumbs\Models\Laracrumb|null
     */
    public static function findOrCreate($route, $link)
    {
        $laracrumb = Laracrumb::findByLink($link);
        if (is_null($laracrumb)) {
            $mapper = LaracrumbMap::where('route_name', '=', $route->getName())->first();
            if (!is_null($mapper) && UtilityService::mappedFunctionExists($mapper->function_name)) {
                $funcName = $mapper->function_name;
                return $funcName($route, $link);
            }
        } else {
            return $laracrumb;
        }
        return null;
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

    /**
     * Register a Laracrumb with the given settings. A second optional parameter
     * can be passed to overwrite and existing Laracrumb.
     *
     * @param  array   $settings
     * @param  boolean $overwrite   (optional) boolean flag that defaults to false
     */
    public static function register($settings, $overwrite = false)
    {
        if (!empty($settings['map'])) {
            self::registerComplex($params);
        } elseif (empty($settings['link'])) {
            self::registerWithoutLink($settings, $overwrite);
        } else {
            self::registerBasic($settings, $overwrite);
        }
    }

    /**
     * Register a new no-link Laracrumb.
     *
     * @param array   $settings
     * @param boolean $overwrite
     */
    protected static function registerWithoutLink($settings)
    {
        $fauxLink = UtilityService::createFauxLink(
            $settings['display_text'], 
            !empty($settings['parent_id']) ? $settings['parent_id'] : 00
        );
        $settings['link'] = $fauxLink;
        $laracrumb = Laracrumb::findByLink($fauxLink);
        if (!is_null($laracrumb) && $overwrite) {
            $laracrumb->delete();
        } else {
            return;
        }
        self::createNew($settings);
    }

    /**
     * Register a new basic Laracrumb.
     *
     * @param array   $settings
     * @param boolean $overwrite
     */
    protected static function registerBasic($settings, $overwrite = false)
    {
        $laracrumb = Laracrumb::findByLink($settings['link']);
        if (!is_null($laracrumb) && $overwrite) {
            $laracrumb->delete();
        } elseif (!is_null($laracrumb)) {
            return;
        }
        self::createNew($settings);
    }

    /**
     * Register a new complex Laracrumb.
     *
     * @param array   $settings
     * @param boolean $overwrite
     */
    protected static function registerComplex($settings, $overwrite = false)
    {
        $map = LaracrumbMap::findByRoute($settings['route_name']);
        if (!is_null($map) && $overwrite) {
            $map->delete();
        } elseif (!is_null($map)) {
            return;
        }
        self::createNewMap($settings['route_name'], $settings['map']);
    }

    /**
     * Create a new Laracrumb.
     *
     * @param string $routeName
     * @param string $funcName
     */
    protected static function createNewMap($routeName, $funcName)
    {
        $map = new LaracrumbMap();
        $map->route_name = $routeName;
        $map->function_name = $funcName;
        $map->save();
    }

    /**
     * Create a new Laracrumb.
     *
     * @param array $settings
     */
    protected static function createNew($settings)
    {
        $crumb = new Laracrumb();
        foreach ($settings as $attr => $value) {
            $crumb->$attr = $value;
        }
        $crumb->save();
    }
}
