<?php

namespace Shureban\LaravelLogplex\Channels;

use Shureban\LaravelLogplex\LogRecord;

interface Channel
{
    public function send(LogRecord $logRecord): void;
}
