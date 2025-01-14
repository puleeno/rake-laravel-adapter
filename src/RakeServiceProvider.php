<?php

namespace Rake\LaravelAdapter;

use Illuminate\Support\ServiceProvider;

class RakeServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Đăng ký migrations
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        // Nếu muốn cho phép publish migrations
        $this->publishes([
            __DIR__.'/../database/migrations' => database_path('migrations')
        ], 'rake-migrations');
    }

    public function register()
    {
        // Register các service khác của package
    }
}