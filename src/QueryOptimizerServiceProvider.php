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
        $this->loadMigrationsFrom(__DIR__ . '/Database/migrations');
        
        // Listen to query events using a Closure
        DB::listen(function ($query) {
            // Instantiate the QueryListener and pass the $query to its handle method
            $listener = app(QueryListener::class);
            $listener->handle($query);
        });

        // Register artisan commands
        if ($this->app->runningInConsole()) {
            $this->commands([
                Commands\AnalyzeQueriesCommand::class,
            ]);
        }
    }
}
