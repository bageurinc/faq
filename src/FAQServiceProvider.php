<?php

namespace Bageur\FAQ;

use Illuminate\Support\ServiceProvider;

class FAQServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // include __DIR__.'/routes/web.php';
        $this->app->make('Bageur\FAQ\FAQController');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');
        $this->loadMigrationsFrom(__DIR__.'/migration');
    }
}
