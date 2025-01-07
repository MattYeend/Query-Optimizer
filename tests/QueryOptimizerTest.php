<?php 

namespace Tests;

use PHPUnit\Framework\TestCase;
use MattYeend\QueryOptimizer\Services\QueryAnalyzer;

class QueryOptimizerTest extends TestCase
{
    public function testQueryAnalyzerSuggestions()
    {
        $analyzer = new QueryAnalyzer();
        $query = 'SELECT * FROM users';
        $suggestions = $analyzer->analyze($query);

        $this->assertContains('Avoid using SELECT *. Specify the columns needed.', $suggestions);
    }
}