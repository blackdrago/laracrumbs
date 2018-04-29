<?php
/**
 * Contains the Conductor class.
 *
 * @package Laracrumbs
 * @author  K. McCormick <kyliemccormick@gmail.com>
 */
namespace Laracrumbs;

use Laracrumbs\Services\RouteService;
use Laracrumbs\Models\Laracrumb;

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
     */
    public function render()
    {
        $route = \Route::getCurrentRoute();
        $identifier = RouteService::getIdentifier($route);
        $laracrumb = Laracrumb::where('route_identifier', '=', $identifier)->first();
        if (!is_null($laracrumb)) {
            return view(config('laracrumbs.template'), ['laracrumb' => $laracrumb]);
        }
        return '&nbsp;';
    }
}
