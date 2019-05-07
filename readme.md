[![Maintainability](https://api.codeclimate.com/v1/badges/f24837ce3bb6cedb9205/maintainability)](https://codeclimate.com/github/botnetdobbs/Laravel-Tdd/maintainability)


## Setup

### Dependencies

* [PHP 7](http://php.net/) - popular general-purpose scripting language suited to web development
* [Laravel 5.8](https://laravel.com/docs/5.8) - A web application framework built with PHP

### Getting Started

Setting up project in development mode

* Ensure PHP 7.0 is installed by running:
```
php -v
```

* Clone the repository to your machine and navigate into it:
```
git clone https://github.com/botnetdobbs/Laravel-Tdd.git && cd Laravel-Tdd
```
* Install application dependencies:
```
composer install
```
* Create a *.env* file and include the necessary environment variables. NB- copy from the *.env.example* and fill in the correct values

## Database setup
Create your database locally on your machine, i.e `laravel_tdd`cand add it as a value to the respective environment variable as below.
```
DB_DATABASE=laravel_tdd
```
- Also create a sqlite file for testing by running this command on your project root
```
touch database/testing.sqlite
```

## Running the application
Inside the project root folder, run the command below in your console
```
$ php artisan migrate:fresh
```
```
$ php artisan db:seed
```
```
$ php artisan serve
```
## Running the tests
### Browser tests
```
- $ php artisan dusk
```

### Unit && Feature tests
```
- $ ./vendor/bin/phpunit
```

- Pardon on the UI. The focus of this is on Testing the laravel.
