<?php

namespace Neondigital\Identify;

use Neondigital\Identify\Middleware\IdentifyMiddleware;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class IdentifyServiceProvider extends BaseServiceProvider
{
    public function boot(): void
    {
        $this->publishes([
            __DIR__.'/config/identifies.php' => config_path('identifies.php'),
        ], 'identify-config');

        $this->loadMigrationsFrom(__DIR__.'/Database/Migrations');

        $this->loadRoutesFrom(__DIR__.'/routes.php');

        $this->loadViewsFrom(__DIR__.'/Views', 'identify');

        $this->app['router']->aliasMiddleware('identify', IdentifyMiddleware::class);
    }

    public function register()
    {
        //
    }
}
