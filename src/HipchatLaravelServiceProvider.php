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
        $this->package('hernandev/hipchat-laravel');
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

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array('hipchat-laravel');
    }
}
