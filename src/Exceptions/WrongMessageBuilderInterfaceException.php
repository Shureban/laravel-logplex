<?php

namespace Shureban\LaravelLogplex\Exceptions;

use Shureban\LaravelLogplex\Builder\MessageBuilderInterface;
use Throwable;

class WrongMessageBuilderInterfaceException extends LogplexException
{
    public function __construct(string $class, int $code = 0, ?Throwable $previous = null)
    {
        $message = sprintf('Class %s is not an instance of %s', $class, MessageBuilderInterface::class);

        parent::__construct($message, $code, $previous);
    }
}
