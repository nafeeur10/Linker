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

## Install Docker Engine on Ubuntu

My Docker Version **25.0.0**. To Install run these commands:

```
# Add Docker's official GPG key:
sudo apt-get update
sudo apt-get install ca-certificates curl
sudo install -m 0755 -d /etc/apt/keyrings
sudo curl -fsSL https://download.docker.com/linux/ubuntu/gpg -o /etc/apt/keyrings/docker.asc
sudo chmod a+r /etc/apt/keyrings/docker.asc

# Add the repository to Apt sources:
echo \
  "deb [arch=$(dpkg --print-architecture) signed-by=/etc/apt/keyrings/docker.asc] https://download.docker.com/linux/ubuntu \
  $(. /etc/os-release && echo "$VERSION_CODENAME") stable" | \
  sudo tee /etc/apt/sources.list.d/docker.list > /dev/null
sudo apt-get update

sudo apt-get install docker-ce docker-ce-cli containerd.io docker-buildx-plugin docker-compose-plugin
```

## Install Docker-Compose on Ubuntu

My Docker Compose version **v2.24.2**. Remove previous version if you are using any version before 2.24.2. 
```
sudo apt remove docker-compose
```

To Install run these commands:

```
sudo curl -SL https://github.com/docker/compose/releases/download/v2.24.2/docker-compose-linux-x86_64 -o /usr/local/bin/docker-compose 
sudo chmod +x /usr/local/bin/docker-compose
```
To check the version:

```
docker-compose --version
```

## Setup Guideline

1. `git clone https://github.com/nafeeur10/Linker.git`
2. `docker-compose up --build -d`
3. Go to the docker exec with command `docker-compose exec php bash`
4. Give permission (it could miss) `chmod 777 -R .`
5. `composer install`
6. `npm install`
7. Set your database in `.env` file. 
 ```DB_CONNECTION=mysql
    DB_HOST=mysql
    DB_PORT=3306
    DB_DATABASE=links
    DB_USERNAME=root
    DB_PASSWORD=NrR@6307001
```
8. Set your Redis Environment 
 ```EDIS_CLIENT=predis
    CACHE_DRIVER=redis
    SESSION_DRIVER=redis
    QUEUE_CONNECTION=redis
```
9. Run the migration `php artisan migrate`
10. Run the queue: `php artisan queue:work`

## Browse Link

```
http://localhost:8001
```

## Testing

Wrote unit testing for Helper function `getMainDomain()`. Added three test cases. All are passed. 

## Video of Assignment

https://www.loom.com/share/ff02f8b8b4124bc190ec3f510a351b89?sid=c8ac9d2a-2f13-4fff-ae3c-495eb69481f8