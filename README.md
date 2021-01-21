## About LaravelAdminlte

LaravelAdminlte is a backend admin panel with adminlte theme based on laravel framework.

## Installation
1. Run `composer create-project --prefer-dist logtous/laravel_adminlte YourProject "1.*"`
2. Run `copy .env.example .env`
3. Run `sudo chgrp -R www-data storage bootstrap/cache && sudo chmod -R ug+rwx storage bootstrap/cache`
4. Create DB: `mysql -hlocalhost -uroot -psecret -e "CREATE DATABASE laravel  DEFAULT CHARSET utf8mb4 COLLATE utf8mb4_general_ci;"`
5. Run `php artisan migrate --seed` 

## Backend admin url
>`http://laravel_adminlte.test`
account: `laravel_adminlte@logtous.com`
password: `12345678`


## Adminlte Examples
http://laravel_adminlte.test/adminlte/index
