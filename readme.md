# Address book API
This is a simple dockerised Laravel API with a MySQL database.

Build the images and start the services:
```
docker-compose build
docker-compose up
```

To populate the database with mock data enter the container bash terminal and run:
```
php artisan migrate:refresh --seed
```

### phpunit
To execute tests run:
```
vendor/phpunit/phpunit/phpunit
```
