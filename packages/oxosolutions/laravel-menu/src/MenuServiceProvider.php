<?php

namespace OxoSolutions\Menu;

use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\AliasLoader;

class MenuServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        if (! $this->app->routesAreCached()) {
                require  __DIR__.'/routes.php';
        }

        $this->publishes([
            __DIR__.'/../config/menu.php'  => config_path('menu.php'),
        ], 'config');

        $this->publishes([
           __DIR__.'/Views'   => resource_path('views/vendor/oxosolutions-menu'),
        ], 'view');

         $this->publishes([
            __DIR__.'/../assets' => public_path('vendor/oxosolutions-menu'),
        ], 'public');

        $this->publishes([
            __DIR__.'/../migrations/2017_08_11_073824_create_menus_table.php' => database_path('migrations/2017_08_11_073824_create_menus_table.php'),
            __DIR__.'/../migrations/2017_08_11_074006_create_menu_items_table.php' => database_path('migrations/2017_08_11_074006_create_menu_items_table.php'),
        ], 'migrations');
        
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('oxosolutions-menu', function() {
            return new WMenu();
        });

        $this->app->make('OxoSolutions\Menu\Controllers\MenuController');
        $this->loadViewsFrom(__DIR__.'/views', 'wmenu');

    }
}
