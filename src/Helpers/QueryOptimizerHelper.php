<?php

namespace MattYeend\QueryOptimizer\Helpers;

class QueryOptimizerHelper
{
    public static function analyzeQuery(string $query): array
    {
        $suggestions = [];

        if (strpos($query, '*') !== false) {
            $suggestions[] = 'Avoid using SELECT *; specify columns explicitly.';
        }
        if (!str_contains($query, 'WHERE')) {
            $suggestions[] = 'Consider adding a WHERE clause to optimize query performance.';
        }

        return $suggestions;
    }
}
