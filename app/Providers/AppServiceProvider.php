<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\UrlGenerator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Force HTTPS when REDIRECT_HTTPS=true in .env
        if (env('REDIRECT_HTTPS')) {
            $this->app['request']->server->set('HTTPS', true);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(UrlGenerator $urlGenerator)
    {
        // Force HTTPS when REDIRECT_HTTPS=true in .env
        if (env('REDIRECT_HTTPS')) {
            $urlGenerator->formatScheme('https');
        }
    }
}
