<?php

namespace Carlson\NovaSimpleContent;

use Illuminate\Support\ServiceProvider;

class NovaSimpleContentServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'nova-simple-content');

        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        $this->publishes([
            __DIR__ . '/../resources/views' => resource_path('views/vendor/nova-simple-content'),
        ], 'nova-simple-content-views');

        $this->publishes([
            __DIR__ . '/../config/nova-simple-content.php' => config_path('nova-simple-content.php'),
        ], 'nova-simple-content-config');
    }
}
