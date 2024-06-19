<?php

namespace Shureban\LaravelLogplex\Channels\Slack\Blocks;

use Shureban\LaravelLogplex\Channels\Slack\Block;
use Shureban\LaravelLogplex\Channels\Slack\Elements\HeaderSection;
use Shureban\LaravelLogplex\Channels\Slack\Elements\TextSection;
use Shureban\LaravelLogplex\LogRecord;

class RequestBlock implements Block
{
    private LogRecord $logRecord;

    /**
     * @param LogRecord $logRecord
     */
    public function __construct(LogRecord $logRecord)
    {
        $this->logRecord = $logRecord;
    }

    public function toArray(): array
    {
        $request = $this->logRecord->getRequest();

        if (is_null($request) || app()->runningInConsole()) {
            return [];
        }

        $requestData = $request->all();
        $result      = [
            (new HeaderSection('Request information :pinched_fingers:'))->toArray(),
            (new TextSection(sprintf('%s: %s', $request->method(), $request->fullUrl())))->toArray(),
        ];

        if (count($requestData) > 0) {
            (new TextSection(sprintf("```%s```", json_encode($requestData))))->toArray();
        }

        return $result;
    }
}
