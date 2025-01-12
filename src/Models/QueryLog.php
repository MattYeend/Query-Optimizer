<?php

namespace MattYeend\QueryOptimizer\Models;

use Illuminate\Database\Eloquent\Model;

class QueryLog extends Model
{
    protected $table = 'query_logs';

    protected $fillable = ['query', 'bindings', 'time'];

    protected $casts = [
        'bindings' => 'array',
    ];
}
