<?php

namespace Shureban\LaravelLogplex;

use Monolog\Level;
use Monolog\Logger as MonologLogger;

class LogplexLogger
{
    /**
     * Create a custom Monolog instance.
     *
     * @param array $config
     *
     * @return MonologLogger
     */
    public function __invoke(array $config): MonologLogger
    {
        return new MonologLogger(env('APP_NAME'), [
            new LogplexHandler(
                $config['channels'] ?? [],
                $config['level'] ?? Level::Debug
            ),
        ]);
    }
}
