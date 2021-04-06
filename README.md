# Introduction
Created the game "Scissors, Rock, Paper" as a web application using the PHP Laravel Framework

## System requirements

- PHP 7.*
- Composer

## Installation

Clone the repository
```bash
https://github.com/zohaibalvi/scissors-rock-paper-laravel.git
```

Switch to the repo folder
```bash
cd scissors-rock-paper-laravel
```

Install all the dependencies using composer
```bash
composer install
```

Copy the example env file and make the required configuration changes in the .env file
```bash
cp .env.example .env
```

Generate a new application key
```bash
php artisan key:generate
```

Run the database migrations (Set the database connection in .env before migrating)
```bash
php artisan migrate
```

Start the local development server
```bash
php artisan serve
```
