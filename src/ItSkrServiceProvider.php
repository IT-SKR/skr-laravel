<?php

namespace Itskr\SkrLaravel;

use Illuminate\Support\ServiceProvider;

class ItSkrServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app['skr'] = $this->app->share(function ($app){
            return new Skr($app['session'],$app['config']);
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
        $this->loadViewsFrom(__DIR__.'/views','Skr');
        $this->publishes([
            __DIR__.'/views'=>base_path('resources/views/skr'),
            __DIR__.'/config/skr.php'=>config_path('skr.php')
        ]);

    }
}
