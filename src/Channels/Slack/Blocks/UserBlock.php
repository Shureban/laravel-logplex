<?php

namespace Shureban\LaravelLogplex\Channels\Slack\Blocks;

use Shureban\LaravelLogplex\Channels\Slack\Block;
use Shureban\LaravelLogplex\Channels\Slack\Elements\FieldsSection;
use Shureban\LaravelLogplex\Channels\Slack\Elements\HeaderSection;
use Shureban\LaravelLogplex\LogRecord;

class UserBlock implements Block
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
        $user = $this->logRecord->getUser();

        if (is_null($user)) {
            return [];
        }

        return [
            (new HeaderSection('User info :information_desk_person:'))->toArray(),
            (new FieldsSection([
                sprintf("*Id:*\n%s", $user->getAuthIdentifierName()),
                sprintf("*Email:*\n%s", $user->getEmailForPasswordReset()),
            ]))->toArray(),
        ];
    }
}
