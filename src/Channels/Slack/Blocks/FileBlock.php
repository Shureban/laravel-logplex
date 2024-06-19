<?php

namespace Shureban\LaravelLogplex\Channels\Slack\Blocks;

use Shureban\LaravelLogplex\Channels\Slack\Block;
use Shureban\LaravelLogplex\Channels\Slack\Elements\HeaderSection;
use Shureban\LaravelLogplex\Channels\Slack\Elements\TextSection;
use Shureban\LaravelLogplex\LogRecord;
use Shureban\LaravelLogplex\TraceRow;

class FileBlock implements Block
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

        $exceptionClass = $this->getExceptionClass();

        if (is_null($exceptionClass)) {
            return [];
        }

        $file = str_replace(base_path('/'), '', $exception->getFile());
        $line = $exception->getLine();

        return [
            (new HeaderSection('File :file_folder:'))->toArray(),
            (new TextSection(sprintf('%s:%d', $file, $line)))->toArray(),
        ];
    }

    /**
     * @return TraceRow|null
     */
    private function getExceptionClass(): ?TraceRow
    {
        $exceptionFile = null;

        foreach ($this->logRecord->getExceptionTrace() as $traceRow) {
            if (is_null($exceptionFile) && !$traceRow->isVendorClass()) {
                $exceptionFile = $traceRow;
                break;
            }
        }

        return $exceptionFile;
    }
}
