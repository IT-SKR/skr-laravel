<?php

namespace Itskr\SkrLaravel;

use Illuminate\Support\ServiceProvider;

class SkrServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->singleton('skr', function ($app) {
            return new Skr();
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
//        $this->loadViewsFrom(__DIR__.'/views','Skr');
        $this->publishes([
//            __DIR__.'/views'=>base_path('resources/views/skr'),
            __DIR__ . '/config/skr' => config_path('skr')
        ]);

    }
}
