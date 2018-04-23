<?php
/**
 * Contains the Laracrumb class.
 *
 * @package Laracrumbs\Models
 */
namespace Laracrumbs\Models;

use Illuminate\Database\Eloquent\Model;
use Laracrumbs\Services\UtilityService;

/**
 * Laracrumb encapsulates a single breadcrumb and provides access to its ancestors.
 */
class Laracrumb extends Model
{
    /** @var string $table                The name of the database table. */
    protected $table = 'laracrumbs';

    /** @var string $primaryKey           The primary column key for this model. */
    protected $primaryKey = 'id';

    /** @var boolean $incrementing        Boolean flag indicating incrementing IDs. */
    public $incrementing = true;

    /** @var boolean $timestamps          Boolean flag for using timestamps. */
    public $timestamps;

    /** @var array $fillable              The model attributes that can be mass-filled. */
    protected $fillable = [
        'id', 'name', 'link', 'title', 'route', 'parent_id'
    ];

    /**
     * Get the parent crumb, if it exists.
     *
     * @return \Laracrumbs\Models\Laracrumb|null
     */
    public function parent()
    {
        if (!is_null($this->attributes['parent_id'])) {
            return Laracrumb::where('id', '=', $this->attributes['parent_id'])->first();
        }
        return null;
    }

    /**
     * Return an ordered array of all crumbs with this crumb as the leaf.
     *
     * @param  array $crumbs
     * @return array
     */
    public function collectCrumbs($crumbs = [])
    {
       $crumbs[] = $this;
       $parent = $this->parent();
       if (!is_null($parent)) {
           return $parent->collectCrumbs($crumbs);
       }
       return array_reverse($crumbs);
    }

    /**
     * Check if this Laracrumb has a link.
     *
     * @return boolean
     */
    public function hasLink()
    {
        return !empty($this->attributes['link'])
            || !empty($this->attributes['route']);
    }

    /**
     * Check if this Laracrumb has a title.
     *
     * @return boolean
     */
    public function hasTitle()
    {
        return !empty($this->attributes['title']);
    }

    /**
     * Get the crumb name.
     *
     * @return string
     */
    public function name()
    {
        return UtilityService::translate($this->attributes['name']);
    }

    /**
     * Get the crumb title if it exits.
     *
     * @return string|null
     */
    public function title()
    {
        if (empty($this->attributes['title'])) {
            return null;
        }
        return UtilityService::translate($this->attributes['title']);
    }

    /**
     * Get the crumb link if it exits.
     *
     * @return string|null
     */
    public function link()
    {
        if (!$this->hasLink()) {
            return null;
        }
        if (!empty($this->attributes['link'])) {
            return $this->attributes['link'];
        }
        return route($this->attributes['route']);
    }
}
