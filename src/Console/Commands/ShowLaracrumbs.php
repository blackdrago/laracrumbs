<?php
/**
 * Contains the ShowLaracrumbs class.
 *
 * @package Laracrumbs\Console\Commands
 * @author  K. McCormick <kyliemccormick@gmail.com>
 */
namespace Laracrumbs\Console\Commands;

use Illuminate\Console\Command;
use Laracrumbs\Models\Laracrumb;
use Laracrumbs\Models\LaracrumbMap;

/**
 * Show the existing Laracrumbs via console command.
 */
class ShowLaracrumbs extends Command
{
    /** @var string $signature         The name and signature of the console command. */
    protected $signature = 'laracrumbs:show';

    /** @var string $description       Description of the command. */
    protected $description = 'Displays all known Laracrumbs.';

    /** @var array $laracrumbHeaders   The table headers for Laracrumbs info. */
    protected $laracrumbHeaders = ['id', 'display_text', 'title', 'link', 'parent_id'];

    /** @var array $mapHeaders         The table headers for Laracrumb Map info. */
    protected $mapHeaders = ['id', 'route_name', 'function_name'];

    /** @var array $laracrumbs         An array of all the Laracrumbs. */
    protected $laracrumbs;

    /** @var array $maps               An array of mapped Laracrumbs. */
    protected $maps;

    /**
     * Create a new command instance.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->laracrumbs = Laracrumb::all();
        $this->maps = LaracrumbMap::all();
        if (count($this->laracrumbs) == 0 && count($this->maps) == 0) {
           return $this->error("There are currently no Laracrumbs saved nor mapped Laracrumbs for routes.");
        }
        $this->info("There are currently " . count($this->laracrumbs) . " saved Laracrumbs.");
        if (count($this->laracrumbs) > 0) {
            $this->displayLaracrumbs($this->getLaracrumbsInfo());
        }
        $this->info("There are currently " . count($this->maps) . " mapped Laracrumbs for routes.");
        if (count($this->maps) > 0) {
            $this->displayLaracrumbMaps($this->getLaracrumbMapsInfo());
        }
    }

    /**
     * Display the laracrumbs in a table format.
     *
     * @param array $laracrumbs
     */
    protected function displayLaracrumbs($laracrumbs)
    {
        $this->table($this->laracrumbHeaders, $laracrumbs);
    }

    /**
     * Display the laracrumb maps in a table format.
     *
     * @param array $maps
     */
    protected function displayLaracrumbMaps($maps)
    {
        $this->table($this->mapHeaders, $maps);
    }

    /**
     * Get all existing Laracrumbs cell data for the table.
     *
     * @return array
     */
    protected function getLaracrumbsInfo()
    {
        $data = [];
        foreach ($this->laracrumbs as $laracrumb) {
            $data[] = [
                'id' => $laracrumb->id,
                'display_text' => $laracrumb->display_text,
                'title' => !empty($laracrumb->title) ? $laracrumb->title : '',
                'link' => $laracrumb->hasLink() ? $laracrumb->link : 'n/a',
                'parent_id' => !empty($laracrumb->parent_id) ? $laracrumb->parent_id : 'NONE',
            ];
        }
        return $data;
    }

    /**
     * Get all existing Laracrumb Maps cell data for the table.
     *
     * @return array
     */
    protected function getLaracrumbMapsInfo()
    {
        $data = [];
        foreach ($this->maps as $map) {
            $data[] = [
                'id' => $map->id,
                'route_name' => $map->route_name,
                'function_name' => $map->function_name
            ];
        }
        return $data;
    }
}
