<?php

namespace MattYeend\QueryOptimizer\Listeners;

use Illuminate\Database\Events\QueryExecuted;
use MattYeend\QueryOptimizer\Models\QueryLog;

class QueryListener
{
    public function handle(QueryExecuted $event)
    {
        QueryLog::create([
            'query' => $event->sql,
            'bindings' => json_encode($event->bindings),
            'time' => $event->time,
        ]);
    }
}
