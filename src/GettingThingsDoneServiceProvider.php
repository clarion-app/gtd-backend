<?php

namespace ClarionApp\GettingThingsDone;

use ClarionApp\Backend\ClarionPackageServiceProvider;

class GettingThingsDoneServiceProvider extends ClarionPackageServiceProvider
{
    public function boot(): void
    {
        parent::boot();
        
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        if(!$this->app->routesAreCached())
        {
            require __DIR__.'/Routes.php';
        }
    }

    public function register(): void
    {
        parent::register();
    }
}
