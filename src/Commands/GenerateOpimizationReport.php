<?php

namespace MattYeend\QueryOptimizer;

use Illuminate\Console\Command;
use DB;
use MattYeend\QueryOptimizer\Services\QueryAnalyzer;

class GenerateOptimizationReport extends Command
{
    protected $signature = 'query-optimizer:report';
    protected $description = 'Generate a query optimization report';

    public function handle()
    {
        DB::enableQueryLog();
        $this->info('Query Optimization Report:');

        $queries = DB::getQueryLog();
        foreach($queries as $query){
            $this->info('Query: ' . $query['query']);
            $this->info('Execution Time: ' . $query['time'] . 'ms');

            $analyzer = new QueryAnalyzer;
            $suggestions = $analyzer->analyze($query['query']);

            if(!empty($suggestions)){
                $this->warn('Suggestions:');
                foreach($suggestions as $suggestion){
                    $this->warn('- ' . $suggestion);
                }
            }
        }
    }
}