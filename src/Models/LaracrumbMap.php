<?php
/**
 * Contains the LaracrumbMap class.
 *
 * @package Laracrumbs\Models
 */
namespace Laracrumbs\Models;

use Illuminate\Database\Eloquent\Model;
use Laracrumbs\Services\UtilityService;

/**
 * LaracrumbMap binds a named route to a function that generates its Laracrumb.
 */
class LaracrumbMap extends Model
{
    /** @var string $table                The name of the database table. */
    protected $table = 'laracrumb_maps';

    /** @var string $primaryKey           The primary column key for this model. */
    protected $primaryKey = 'id';

    /** @var boolean $incrementing        Boolean flag indicating incrementing IDs. */
    public $incrementing = true;

    /** @var boolean $timestamps          Boolean flag for using timestamps. */
    public $timestamps = false;

    /** @var array $fillable              The model attributes that can be mass-filled. */
    protected $fillable = [
        'id', 'route_name', 'function_name'
    ];

    /**
     * Find a map by route name.
     *
     * @param  string $routeName
     * @return \Laracrumbs\Models\LaracrumbMap|null
     */
    public static function findByRoute($routeName)
    {
        return LaracrumbMap::where('route_name', '=', $routeName)->first();
    }
}
