# Laravel Query Optimizer

A package to analyze and optimize database queries in Laravel.

## Features
- Logs slow queries.
- Provides optimization suggestions.
- Query result caching.
- Query optimization reports.

## Installation 
1. Install via Composer: 
`composer require MattYeend/query-optimizer`
2. Publish the configuration file:
`php artisan vendor:publish --tag=config`
3. Add the middleware to `Kernal.php` if you want to log the queries:
`'query.log' => \MattYeend\QueryOptimizer\Middleware\LogQueries::class,`

## Commands
Generate optimization reports: 
`php artisan query-optimizer:report`

## Configuration
Edit `config/query_optimizer.php` to customize the settings.

## License
This package is licensed under the MIT License.

## Contributing
Feel free to fork the repository and submit pull requests for improvements or new features!
