# Laravel Query Optimizer

A package to analyze and optimize database queries in Laravel.

---

## Installation 
1. Install via Composer: 
    ```bash
    composer require MattYeend/query-optimizer
    ```
2. The service provider is automatically registered
3. Run migrations:
    ```bash
    php artisan migrate
    ```
4. Analyze queries using: 
    ```bash
    php artisan query:analyze
    ```

---

## Features
- Logs all queries with execution time.
- Identifies slow queries.
- Provides optimization suggestions.

---

## License
This package is licensed under the MIT License.

--- 

## Contributing
Feel free to fork the repository and submit pull requests for improvements or new features!
