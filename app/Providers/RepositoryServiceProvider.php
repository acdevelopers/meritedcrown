<?php

namespace App\Providers;


use Illuminate\Support\ServiceProvider;

/**
 * Class RepositoryServiceProvider.
 *
 * @package App\Providers
 */
class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(\App\Contracts\Repositories\RoleRepositoryInterface::class, \App\Repositories\RoleRepository::class);
        $this->app->bind(\App\Contracts\Services\RoleServiceInterface::class, \App\Services\RoleService::class);
        $this->app->bind(\App\Contracts\Repositories\PageRepositoryInterface::class, \App\Repositories\PageRepository::class);
        $this->app->bind(\App\Contracts\Services\PageServiceInterface::class, \App\Services\PageService::class);
        //:end-bindings:
    }
}