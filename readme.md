## About the Exercise:

The project was created using the following technologies:
- Laravel 5.6.35
- MongoDB
- JQuery 3.2
- Bootstrap 4

## Installation Steps

### Build project
```
docker-compose up -d
```

### Install Composer dependencies
```
docker-compose exec php composer install
```
### Install NPM dependencies
```
npm install
```
### Build static files
```
npm run prod
```
### Run seeder
```
docker-compose exec php php artisan db:seed
```
