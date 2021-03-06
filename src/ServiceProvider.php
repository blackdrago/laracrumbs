<?php
/**
 * Contains the ServiceProvider class.
 *
 * @package Laracrumbs
 * @author  K. McCormick <kyliemccormick@gmail.com>
 */
namespace Laracrumbs;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Blade;
use Laracrumbs\Conductor;

/**
 * ServiceProvider for Laracrumbs, a database-driven breadcrumbs package for Laravel.
 *
 * @see https://laravel.com/docs/5.6/providers Service Providers
 */
class ServiceProvider extends BaseServiceProvider
{
    /** @var string $sourceDir          The package's source code directory. */
    private $sourceDir = __DIR__;

    /** @var string $packageKey         The package key for translations, views, etc. */
    private $packageKey = 'laracrumbs';

    /** @var array $commands            An array of console commands. */
    protected $commands = [
        'Laracrumbs\Console\Commands\ShowLaracrumbs'
    ];

    /**
     * Bootstrap services for Laracrumbs.
     */
    public function boot()
    {
        $this->loadMigrationsFrom($this->getSourcePath(['database', 'migrations']));

        // translations and language strings
        $langPath = $this->getSourcePath(['resources', 'lang']);
        $this->loadTranslationsFrom($langPath, $this->packageKey);

        // Blade templates and views
        $viewPath = $this->getSourcePath(['resources', 'views']);
        $this->loadViewsFrom($viewPath, $this->packageKey);

        // publishes language strings, config, and views for override capability
        $publicPath = $this->getSourcePath(['public']);
        $configPath = $this->getSourcePath(['config', "{$this->packageKey}.php"]);
        $this->publishes([$publicPath => public_path("vendor/{$this->packageKey}")], 'public');
        $this->publishes([$configPath => config_path("{$this->packageKey}.php")], 'config');

        // merge configuration values
        $this->mergeConfigFrom($configPath, $this->packageKey);

        // register the laracrumbs
        $this->registerLaracrumbs();
    }

    /**
     * Register services for Laracrumbs.
     */
    public function register()
    {
        // register Laracrumbs Conductor
        $this->app->singleton(Conductor::class, function () {
            return new Conductor();
        });

        // register the Laracrumbs console commands
        $this->commands($this->commands);
    }

    /**
     * Register the custom Laracrumbs for this application.
     */
    public function registerLaracrumbs()
    {
        $files = config('laracrumbs.files');
        if (!empty($files)) {
            foreach ($files as $file) {
                if (file_exists($file)) {
                    require $file;
                }
            }
        }
    }

    /**
     * Given the relative path, return the full source code path.
     *
     * @param  array  $relpath
     * @return string
     */
    public function getSourcePath($relpath)
    {
        array_unshift($relpath, $this->sourceDir);
        return join(\DIRECTORY_SEPARATOR, $relpath);
    }

    /**
     * Get the services provided by Laracrumbs ServiceProvider.
     *
     * @return array
     */
    public function provides()
    {
        return [Conductor::class];
    }
}
