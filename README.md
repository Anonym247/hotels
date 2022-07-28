How to make application ready after fetching from GitHub?

1. run `composer install`

2. create schema in your database with name same in .env.example (DB_DATABASE)

3. run `php artisan migrate --seed`

4. run `php artisan serve`

5. Surf on the browser `http://localhost:8000`
