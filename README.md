# Laravel logplex

## Installation

Require this package with composer using the following command:

```bash
composer require shureban/laravel-logplex
```

Add the following class to the `providers` array in `config/app.php`:

```php
Shureban\LaravelLogplex\LogplexServiceProvider::class,
```

## How to use

### 1. Add new row in `config/logging.php`

```
'logplex' => [
    'driver' => 'custom',
    'via'    => \Shureban\LaravelLogplex\LogplexLogger::class,
    'level'  => env('LOGPLEX_LEVEL', \Monolog\Level::Error),
]
```

### 2. Edit you .env file

```
LOG_STACK_CHANNELS=single,logplex
```

or add additional log channel to yours. As example

```
'stack' => [
    'driver'   => 'stack',
    'channels' => ['single','logplex'],
],
```

You can also publish the config file to change implementations (ie. interface to specific class).

```shell
php artisan vendor:publish --provider="Shureban\LaravelLogplex\LogplexServiceProvider"
```

## Result

