<?php

namespace Aybarsm\Laravel\OsMaster;

use Aybarsm\Laravel\OsMaster\Contracts\OsMasterInterface;
use Illuminate\Support\ServiceProvider;

class OsMasterServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/os-master.php',
            'os-master'
        );

        $this->app->singleton(OsMasterInterface::class, OsMaster::class);

        $this->app->alias(OsMasterInterface::class, 'os-master');
    }

    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/os-master.php' => config_path('os-master.php'),
            ], 'config');
        }
    }
}
