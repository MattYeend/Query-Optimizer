<?php

namespace MattYeend\QueryOptimizer\Commands;

use Illuminate\Console\Command;
use MattYeend\QueryOptimizer\Models\QueryLog;

class AnalyzeQueriesCommand extends Command
{
    protected $signature = 'query:analyze';
    protected $description = 'Analyze and report on slow queries';

    public function handle()
    {
        $slowQueries = QueryLog::where('time', '>', 100)->get(); // Threshold: 100ms
        $totalQueries = QueryLog::count();

        $this->info("Total Queries Checked: $totalQueries");
        $this->info("Slow Queries Found: " . $slowQueries->count());

        foreach ($slowQueries as $query) {
            $this->line("\nQuery: {$query->query}");
            $this->line("Bindings: " . json_encode($query->bindings));
            $this->line("Execution Time: {$query->time}ms");

            if (strpos($query->query, '*') !== false) {
                $this->warn('Suggestion: Avoid using SELECT *; specify columns explicitly.');
            }
            if (!str_contains($query->query, 'WHERE')) {
                $this->warn('Suggestion: Add WHERE clause to reduce dataset size.');
            }
        }

        $this->info("\nAnalysis Complete.");
    }
}
