<?php

namespace tenowg\discord;

use Illuminate\Support\ServiceProvider;

class EveDiscordProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__."/config/evediscord.php" => config_path('evediscord.php'),
        ]);
        $this->loadRoutesFrom(__DIR__.'/routes.php');
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom( __DIR__.'/config/evediscord.php', 'evediscord'); 
    }
}
