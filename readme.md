# Address book 

## Description
Simple dockerised Laravel app with MariaDB 


Build the images and start the services:
```
docker-compose build
docker-compose up -d
```

## Helper scripts
Running `composer`, `php artisan` or `phpunit` against the `php` container with helper scripts in the main directory:

### container
Running `./container` takes you inside the `laravel-app` container under user uid(1000) (same with host user)
```
$ ./container
devuser@8cf37a093502:/var/www/html$
```
### db
Running `./db` connects to your database container's daemon using mysql client.
```
$ ./db
mysql>
```

### composer
Run `composer` command, example:
```
$ ./composer dump-autoload

### php-artisan
Run `php artisan` commands, example:
```
$ ./php-artisan make:controller BlogPostController --resource
php artisan make:controller BlogPostController --resource
Controller created successfully.
```

### phpunit
Run `./vendor/bin/phpunit` to execute tests, example:
```
$ ./phpunit --group=failing
