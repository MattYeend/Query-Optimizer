<?php

namespace MattYeend\QueryOptimizer;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;
use MattYeend\QueryOptimizer\Listeners\QueryListener;

class QueryOptimizerServiceProvider extends ServiceProvider
{
    public function register()
    {
        // Register services
    }

    public function boot()
    {
        // Register migrations
        $this->loadMigrationsFrom(__DIR__ . '/Migrations');
        
        // Listen to query events
        DB::listen([QueryListener::class, 'handle']);
        
        // Register artisan commands
        if ($this->app->runningInConsole()) {
            $this->commands([
                Commands\AnalyzeQueriesCommand::class,
            ]);
        }
    }
}