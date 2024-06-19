<?php

namespace Shureban\LaravelLogplex\Builder;

use Shureban\LaravelLogplex\Channels\Slack\Message;
use Shureban\LaravelLogplex\LogRecord;

interface MessageBuilderInterface
{
    public function buildSlackMessage(LogRecord $logRecord, string $username, string $emoji): Message;
}
