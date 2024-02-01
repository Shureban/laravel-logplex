<?php

namespace Shureban\LaravelLogplex\Channels\Slack\Blocks;

use Monolog\Level;
use Shureban\LaravelLogplex\Channels\Slack\Block;
use Shureban\LaravelLogplex\Channels\Slack\Elements\HeaderSection;
use Shureban\LaravelLogplex\Channels\Slack\Elements\TextSection;
use Shureban\LaravelLogplex\LogRecord;

class HeaderBlock implements Block
{
    public const EmojiDanger  = ':boom:';
    public const EmojiWarning = ':warning:';
    public const EmojiGood    = ':heavy_check_mark:';
    public const EmojiDefault = ':hatched_chick:';

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
        $level = $this->logRecord->getLevel();
        $title = sprintf('%s %s %s', config('app.env'), $level->getName(), $this->getLevelEmoji($level));

        return [
            (new HeaderSection($title))->toArray(),
            (new TextSection($this->logRecord->getMessage()))->toArray(),
        ];
    }

    /**
     * Returns a Slack message attachment color associated with
     * provided level.
     */
    private function getLevelEmoji(Level $level): string
    {
        return match ($level) {
            Level::Error, Level::Critical, Level::Alert, Level::Emergency => static::EmojiDanger,
            Level::Warning                                                => static::EmojiWarning,
            Level::Info, Level::Notice                                    => static::EmojiGood,
            Level::Debug                                                  => static::EmojiDefault
        };
    }
}
