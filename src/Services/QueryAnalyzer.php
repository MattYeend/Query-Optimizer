<?php

namespace MattYeend\QueryOptimizer\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class QueryAnalyzer
{
    public function analyze($query)
    {
        $suggestions = [];

        // Check for SELECT * usage
        if (preg_match('/SELECT \*/i', $query)) {
            $suggestions[] = 'Avoid using SELECT *. Specify the columns needed.';
        }

        // Check if the query has a WHERE clause
        if (!preg_match('/WHERE/i', $query)) {
            $suggestions[] = 'Queries on large tables should include a WHERE clause.';
        }

        // Check database existence
        if (!$this->checkDatabaseExists()) {
            $suggestions[] = 'Warning: The database does not exist.';
        }

        // Check table existence
        $tableName = $this->extractTableName($query);
        if ($tableName) {
            if (!$this->checkTableExists($tableName)) {
                $suggestions[] = "Warning: The table '{$tableName}' does not exist.";
            }
        }

        return $suggestions;
    }

    private function checkDatabaseExists()
    {
        try {
            $database = DB::getDatabaseName();
            return DB::select("SHOW DATABASES LIKE ?", [$database]) ? true : false;
        } catch (\Exception $e) {
            Log::error('Database existence check failed: ' . $e->getMessage());
            return false;
        }
    }

    private function extractTableName($query)
    {
        if (preg_match('/FROM `?(\w+)`?/i', $query, $matches)) {
            return $matches[1];
        }
        if (preg_match('/INTO `?(\w+)`?/i', $query, $matches)) {
            return $matches[1];
        }
        return null;
    }

    private function checkTableExists($tableName)
    {
        try {
            $result = DB::select("SHOW TABLES LIKE ?", [$tableName]);
            return !empty($result);
        } catch (\Exception $e) {
            Log::error("Table existence check for '{$tableName}' failed: " . $e->getMessage());
            return false;
        }
    }
}
