<?php

namespace CmXperts\Menu\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\AliasLoader;
use CmXperts\Menu\WMenu;

class MenuServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        if (!$this->app->routesAreCached()) {
            require  __DIR__ . '/../../routes/web.php';
        }

        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'cmxperts');

        $this->publishes([
            __DIR__ . '/../../config/menu.php'  => config_path('menu.php'),
        ], 'laravel-menu-config');

        $this->publishes([
            __DIR__ . '/../../resources/views' => resource_path('views/vendor/cmxperts'),
        ], 'laravel-menu-view');

        $this->publishes([
            __DIR__ . '/../../public' => public_path('vendor/cmxperts/menu'),
        ], 'laravel-menu-public');

        $this->publishes([
            __DIR__ . '/../../database/migrations/2023_08_01_073824_create_menu_table.php'
            => database_path('migrations/2023_08_01_073824_create_menu_table.php'),
            __DIR__ . '/../../database/migrations/2023_08_01_074006_create_menu_item_table.php'
            => database_path('migrations/2023_08_01_074006_create_menu_item_table.php'),
        ], 'laravel-menu-migrations');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('cmxperts-menu', function () {
            return new WMenu();
        });

        $this->app->make('CmXperts\Menu\Http\Controllers\MenuController');
        $this->mergeConfigFrom(
            __DIR__ . '/../../config/menu.php',
            'menu'
        );
    }
    protected function migrationExists($mgr)
    {
        $path = database_path('migrations/');
        $files = scandir($path);
        $pos = false;
        foreach ($files as &$value) {
            $pos = strpos($value, $mgr);
            if ($pos !== false) return true;
        }
        return false;
    }
}
