<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            \App\Repositories\Client\ClientRepositoryContract::class,
            \App\Repositories\Client\ClientRepository::class
        );
         $this->app->bind(
            \App\Repositories\User\UserRepositoryContract::class,
            \App\Repositories\User\UserRepository::class
        );
        $this->app->bind(
            \App\Repositories\Pages\PagesRepositoryContract::class,
            \App\Repositories\Pages\PagesRepository::class
        );

         $this->app->bind(
            \App\Repositories\Organization\OrganizationRepositoryContract::class,
            \App\Repositories\Organization\OrganizationRepository::class
        );
       
    }
}
