<?php

namespace Rake\LaravelAdapter;

use Illuminate\Support\ServiceProvider;
use Rake\LaravelAdapter\Database\EloquentDriver;

class RakeServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Load migrations
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

        // Allow publish migrations
        $this->publishes([
            __DIR__ . '/../database/migrations' => database_path('migrations')
        ], 'rake-migrations');
    }

    public function register()
    {
        $this->app->bind('rake.driver', function ($app) {
            $prefix = config('database.connections.mysql.prefix', '');
            return new EloquentDriver($prefix);
        });
    }
}
