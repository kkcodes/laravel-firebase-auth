<?php

namespace Kkcodes\FirebaseAuth;

use Illuminate\Support\ServiceProvider;

class FirebaseAuthServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
        include __DIR__ . "/../routes/web.php";
        $this->loadViewsFrom(__DIR__."/../resources/views", "fireview");

    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->publishes([
            __DIR__.'/../database/migrations/' => database_path('migrations'),
        ]);

        $this->publishes([
            __DIR__.'/../database/seeds/' => database_path('seeds'),
        ]);
    }
}
