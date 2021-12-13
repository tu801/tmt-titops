## Introduction

This is basic test website for Titops. The website is build base on Laravel Framework version 7.x

## System Requirement

The Laravel framework has a few system requirements. 

- PHP >= 7.2.5
- BCMath PHP Extension
- Ctype PHP Extension
- Fileinfo PHP extension
- JSON PHP Extension
- Mbstring PHP Extension
- OpenSSL PHP Extension
- PDO PHP Extension
- Tokenizer PHP Extension
- XML PHP Extension

## Installation

Source code can be run with docker compose. Please install docker before running this source code.

Sync source code from [github](https://github.com/tu801/tmt-titops.git)

Copy `.env.example` file to `.env` file and then fix `DB_HOST` to `DB_HOST=db`, set `DB_USERNAME` and `DB_PASSWORD`

Run the follow command:

- `composer install` => install composer package
- `npm install` => install node package
- `docker-compose up -d` => run project
- `docker-compose exec app php artisan key:generate` => generate laravel APP KEY
- `docker-compose exec app php artisan migrate` => migrate database
- `docker-compose exec app php artisan db:seed --class=DatabaseSeeder` => insert admin user and roles
- `docker-compose exec app php artisan storage:link` => public the upload folder 

Please check the online testing version [here](http://titops.embergame.com/)
