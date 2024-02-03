<p align="center"><a href="https://github.com/nafeeur10" target="_blank"><img width="80" height="80" src="https://img.icons8.com/officel/80/harvester.png" alt="harvester"/></a></p>


## Background of Link Harvester

Link Harvester is a simple app that collects links from users. Any user can submit links that are
validated and stored by the application. Users can see the submitted (links/domains) and
search, and sort those data. The results are displayed in a paginated table.

## Technology Used

- **[Framework: Laravel](https://laravel.com/)**
- **[Front End: AlpineJS](https://alpinejs.dev/)**
- **[Docker](https://www.docker.com/)**
- **[Database: MySQL](https://mysql.com)**
- **[Cache: Redis](https://redis.io/)**
- **[Webserver: nginx](https://www.nginx.com/)**

## Setup Guideline

 - `git clone https://github.com/nafeeur10/Linker.git`
 - `docker-compose up --build -d`
 - Go to the docker exec with command `docker-compose exec php bash`
 - Give permission (it could miss) `chmod 777 -R .`
 - `composer install`
 - `npm install`
 - Set your database in `.env` file. 
 ```DB_CONNECTION=mysql
    DB_HOST=mysql
    DB_PORT=3306
    DB_DATABASE=links
    DB_USERNAME=root
    DB_PASSWORD=NrR@6307001
```
 - Set your Redis Environment 
 ```EDIS_CLIENT=predis
    CACHE_DRIVER=redis
    SESSION_DRIVER=redis
    QUEUE_CONNECTION=redis
```
 - Run the migration `php artisan migrate`
 - Run the queue: `php artisan queue:work`

## Video of Assignment

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).
