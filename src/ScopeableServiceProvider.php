<?php

namespace berthott\Scopeable;

use berthott\Scopeable\Services\ScopeableService;
use Illuminate\Support\ServiceProvider;

class ScopeableServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // bind singletons
        $this->app->singleton('Scopeable', function () {
            return new ScopeableService();
        });

        // add config
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'scopeable');
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // publish config
        $this->publishes([
            __DIR__.'/../config/config.php' => config_path('scopeable.php'),
        ], 'config');
    }
}
