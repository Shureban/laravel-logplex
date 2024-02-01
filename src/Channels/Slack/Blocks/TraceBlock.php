<?php

namespace Shureban\LaravelLogplex\Channels\Slack\Blocks;

use Shureban\LaravelLogplex\Channels\Slack\Block;
use Shureban\LaravelLogplex\Channels\Slack\Elements\HeaderSection;
use Shureban\LaravelLogplex\Channels\Slack\Elements\TextSection;
use Shureban\LaravelLogplex\LogRecord;
use Shureban\LaravelLogplex\TraceRow;

class TraceBlock implements Block
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
        $exception = $this->logRecord->getException();

        if (is_null($exception)) {
            return [];
        }

        $traceFiles = $this->getTraceFiles();

        return [
            (new HeaderSection('Trace :page_with_curl:'))->toArray(),
            (new TextSection(sprintf("```%s```", implode("\n", $traceFiles))))->toArray(),
        ];
    }

    /**
     * @return array
     */
    private function getTraceFiles(): array
    {
        $traceRows = array_filter($this->logRecord->getExceptionTrace(), fn(TraceRow $traceRow) => !$traceRow->isVendorFile());

        return array_map(fn(TraceRow $traceRow) => $traceRow->getFileWithLine(), $traceRows);
    }
}
