<?php

namespace ClarionApp\GettingThingsDone;

use Illuminate\Support\ServiceProvider;

class GettingThingsDoneServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Load migrations
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        if(!$this->app->routesAreCached())
        {
            require __DIR__.'/Routes.php';
        }
    }

    public function register()
    {
        //
    }
}
