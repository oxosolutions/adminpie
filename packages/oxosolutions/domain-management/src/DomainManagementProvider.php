<?php

namespace OxoSolutions\DomainManagement;

use Illuminate\Support\ServiceProvider;

class DomainManagementProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        /*if (!$this->app->routesAreCached()){
            require  __DIR__.'/Routes/routes.php';
        }*/
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        include __DIR__.'/Routes/routes.php';
    }
}
