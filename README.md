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
    'driver'   => 'custom',
    'level'    => env('LOG_LEVEL', 'debug'),
    'via'      => LogplexLogger::class,
    'channels' => [
        new SlackChannel(
            env('SLACK_WEBHOOK_URL'),
            env('SLACK_USERNAME'),
            env('SLACK_EMOJI')
        ),
    ],
]
```

### 2. Edit you .env file

```
LOG_CHANNEL=logplex
```

or add additional log channel to yours. As example

```
'stack' => [
    'driver'   => 'stack',
    'channels' => ['single','logplex'],
],
```

## Result

