<?php
/**
 * Contains the Composer class.
 *
 * @package Laracrumbs
 * @author  K. McCormick <kyliemccormick@gmail.com>
 */
namespace Laracrumbs;

use Laracrumbs\Models\Laracrumb;

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
}
