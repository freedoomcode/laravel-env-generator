<?php

namespace AutoGenerator\Providers;


use Illuminate\Support\ServiceProvider;

class BuilderServiceProvider extends ServiceProvider
{

    protected $commands = [
        'AutoGenerator\Commands\EnvBuilderCommand',
    ];

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->commands($this->commands);
    }
}