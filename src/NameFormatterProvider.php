<?php

namespace TaylorNetwork\Formatters\Name;

use Illuminate\Support\ServiceProvider;

class NameFormatterProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'config/nameformatter.php' => config_path('nameformatter.php'),
        ]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'config/nameformatter.php', 'nameformatter'
        );
    }
}
