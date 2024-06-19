<?php

namespace Shureban\LaravelLogplex;

use Illuminate\Support\ServiceProvider;

class LogplexServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->publishes([__DIR__ . '/../config' => base_path('config')]);
    }
}
