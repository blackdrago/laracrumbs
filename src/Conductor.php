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
     * Render/display the laracrumbs for the given route.
     *
     * @return \Illuminate\Http\Response
     */
    public static function render()
    {
        $route = \Route::getCurrentRoute();
        $link = RouteService::getLink($route);
        $laracrumb = Composer::findOrCreateByRoute($route);
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
       $laracrumb = Composer::findOrCreate($routeName, $params);
       if (!is_null($laracrumb)) {
            return $laracrumb->id;
       }
       return null;
    }

    /**
     * Find a laracrumb id by its display text.
     *
     * @param  string       $text
     * @return integer|null
     */
    public static function findParentIdByDisplayText($text)
    {
        $laracrumb = Laracrumb::findByDisplayText($text);
        if (!is_null($laracrumb)) {
            return $laracrumb->id;
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
            self::registerComplex($settings);
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
    protected static function registerWithoutLink($settings, $overwrite = false)
    {
        $fauxLink = UtilityService::createFauxLink(
            $settings['display_text'], 
            !empty($settings['parent_id']) ? $settings['parent_id'] : 00
        );
        $settings['link'] = $fauxLink;
        $laracrumb = Laracrumb::findByLink($fauxLink);
        if (!is_null($laracrumb) && $overwrite) {
            $laracrumb->delete();
        } elseif (!is_null($laracrumb)) {
            return;
        }
        Composer::create($settings);
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
        Composer::create($settings);
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
        Composer::createMap($settings['route_name'], $settings['map']);
    }
}
