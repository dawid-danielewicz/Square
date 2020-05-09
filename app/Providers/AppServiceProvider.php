<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(\App\Interfaces\RepositoryInterface::class, function() {
            return new \App\Http\Repositories\Repository();
        });

        $this->app->bind(\App\Interfaces\GatewayInterface::class, function() {
            return new \App\Http\Gateways\Gateway();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
