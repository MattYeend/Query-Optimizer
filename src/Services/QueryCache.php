<?php

namespace MattYeend\QueryOptimizer\Services;

use Cache;

class QueryCache
{
    public function cacheQuery($key, callable $query, $ttl = 3600)
    {
        if(Cache::has($key)){
            return Cache::get($key);
        }

        $result = $query();
        Cache::put($key, $result, $ttl);

        return $result;
    }

    public function clearCache($key)
    {
        Cache::forget($key);
    }
}