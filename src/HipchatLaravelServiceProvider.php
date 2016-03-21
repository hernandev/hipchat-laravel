<?php

namespace Hernandev\HipchatLaravel;

use Illuminate\Support\ServiceProvider;

class HipchatLaravelServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     */
    public function boot()
    {
        // published config file
        $this->publishes([
            __DIR__.'/config/hipchat.php' => config_path('hipchat.php')
        ]);
    }

    /**
     * Register the service provider.
     */
    public function register()
    {
        $this->app->singleton('hipchat-laravel', function () {
            return new HipChat();
        });
    }
}
