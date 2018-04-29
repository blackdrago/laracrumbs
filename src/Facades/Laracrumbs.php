<?php
/**
 * Contains the Laracrumbs class.
 *
 * @package Laracrumbs\Facades
 */
namespace Laracrumbs\Facades;

use Illuminate\Support\Facades\Facade;
use Laracrumbs\Conductor;

/**
 * Larcrumbs facade enables easy access to Laracrumb methods throughout the application.
 */
class Laracrumbs extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return Conductor::class;
    }
}
