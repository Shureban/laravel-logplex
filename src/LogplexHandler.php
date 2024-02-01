<?php

namespace Shureban\LaravelLogplex;

use Monolog\Handler\AbstractProcessingHandler;
use Monolog\Level;
use Monolog\LogRecord as BaseLogRecord;
use Shureban\LaravelLogplex\Channels\Channel;

class LogplexHandler extends AbstractProcessingHandler
{
    private array $channels;

    /**
     * @param Channel[]        $channels
     * @param int|string|Level $level
     * @param bool             $bubble
     */
    public function __construct(array $channels, int|string|Level $level = Level::Debug, bool $bubble = true)
    {
        parent::__construct($level, $bubble);

        $this->channels = $channels;
    }

    /**
     * @param BaseLogRecord $record
     *
     * @return void
     */
    protected function write(BaseLogRecord $record): void
    {
        $logRecord = LogRecord::createFromBase($record);

        foreach ($this->channels as $channel) {
            $channel->send($logRecord);
        }
    }
}
