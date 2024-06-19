<?php

namespace Shureban\LaravelLogplex\Channels\Slack\Blocks;

use Shureban\LaravelLogplex\Channels\Slack\Block;
use Shureban\LaravelLogplex\Channels\Slack\Elements\FieldsSection;
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

        $exceptionFile = $this->getExceptionFile();

        if (is_null($exceptionFile)) {
            return [];
        }

        return [
            (new HeaderSection('File :file_folder:'))->toArray(),
            (new TextSection($exceptionFile->getFileWithLine()))->toArray(),
            (new FieldsSection([
                sprintf("*Class:*\n%s", $exceptionFile->getClass()),
                sprintf("*Function:*\n%s", $exceptionFile->getFunction()),
            ]))->toArray(),
        ];
    }

    /**
     * @return TraceRow|null
     */
    private function getExceptionFile(): ?TraceRow
    {
        $exceptionFile = null;

        foreach ($this->logRecord->getExceptionTrace() as $traceRow) {
            if (is_null($exceptionFile) && !$traceRow->isVendorFile()) {
                $exceptionFile = $traceRow;
            }
        }

        return $exceptionFile;
    }
}
