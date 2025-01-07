<?php

namespace MattYeend\QueryOptimizer;

use Illuminate\Support\ServiceProvider;

class QueryOptimizerServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/query_optimizer.php', 'query_optimizer');
    }

    public function boot()
    {
        $this->publishes([
            __DIR__ .'/../config/query_optimizer.php' => config_path('query_optimizer.php'),
        ], 'config');

        $this->commands([
            Commands\GenerateOptimizationReport::class,
        ]);
    }
}