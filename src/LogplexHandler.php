<?php

namespace Shureban\LaravelLogplex;

use Monolog\Handler\AbstractProcessingHandler;
use Monolog\LogRecord as BaseLogRecord;
use Shureban\LaravelLogplex\Builder\MessageBuilderInterface;
use Shureban\LaravelLogplex\Channels\Slack\SlackChannel;
use Shureban\LaravelLogplex\Exceptions\WrongMessageBuilderInterfaceException;

class LogplexHandler extends AbstractProcessingHandler
{
    /**
     * @param BaseLogRecord $record
     *
     * @return void
     * @throws WrongMessageBuilderInterfaceException
     */
    protected function write(BaseLogRecord $record): void
    {
        $logRecord      = LogRecord::createFromBase($record);
        $username       = config('logplex.username');
        $emoji          = config('logplex.emoji');
        $messageBuilder = $this->getMessageBuilder($logRecord);
        $message        = $messageBuilder->buildSlackMessage($logRecord, $username, $emoji);

        (new SlackChannel(config('logplex.webhook_url')))->send($message);
    }

    /**
     * @param LogRecord $logRecord
     *
     * @return MessageBuilderInterface
     * @throws WrongMessageBuilderInterfaceException
     */
    private function getMessageBuilder(LogRecord $logRecord): MessageBuilderInterface
    {
        $builderNamespace = config('logplex.message_builder');
        $builder          = new $builderNamespace($logRecord);

        if ($builder instanceof MessageBuilderInterface) {
            return new $builderNamespace($logRecord);
        }

        throw new WrongMessageBuilderInterfaceException($builderNamespace);
    }
}
