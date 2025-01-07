<?php

namespace MattYeend\QueryOptimizer\Services;

class QueryOptimizer
{
    public function analyze($query)
    {
        $suggestions = [];

        if(preg_match('/SELECT \*/i', $query)){
            $suggestions[] = 'Avoid using SELECT *. Specify the columns needed.';
        }

        if(!preg_match('/WHERE/i', $query)){
            $suggestions[] = 'Queries on large tables should include a WHERE clause.';
        }

        return $suggestions;
    }
}