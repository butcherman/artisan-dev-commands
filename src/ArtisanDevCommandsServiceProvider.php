<?php

namespace Butcherman\ArtisanDevCommands;

use Illuminate\Support\ServiceProvider;

class ArtisanDevCommandsServiceProvider extends ServiceProvider
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
        $this->commands([
            Commands\CleanLogs::class,
            Commands\PurgeAllLogs::class,
            Commands\MakePage::class,
            Commands\MakeTrait::class,
        ]);
    }
}
