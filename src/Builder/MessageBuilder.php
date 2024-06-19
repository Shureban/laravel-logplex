<?php

namespace Shureban\LaravelLogplex\Builder;

use Shureban\LaravelLogplex\Channels\Slack\Blocks\FileBlock;
use Shureban\LaravelLogplex\Channels\Slack\Blocks\HeaderBlock;
use Shureban\LaravelLogplex\Channels\Slack\Blocks\RequestBlock;
use Shureban\LaravelLogplex\Channels\Slack\Blocks\TraceBlock;
use Shureban\LaravelLogplex\Channels\Slack\Blocks\UserBlock;
use Shureban\LaravelLogplex\Channels\Slack\Elements\DividerSection;
use Shureban\LaravelLogplex\Channels\Slack\Message;
use Shureban\LaravelLogplex\LogRecord;

class MessageBuilder implements MessageBuilderInterface
{
    /**
     * @param LogRecord $logRecord
     * @param string    $username
     * @param string    $emoji
     *
     * @return Message
     */
    public function buildSlackMessage(LogRecord $logRecord, string $username, string $emoji): Message
    {
        $message = new Message($username, $emoji);

        $message->addBlock(new HeaderBlock($logRecord));
        $message->addBlock(new RequestBlock($logRecord));
        $message->addBlock(new UserBlock($logRecord));
        $message->addBlock(new FileBlock($logRecord));
        $message->addBlock(new TraceBlock($logRecord));
        $message->addSection(new DividerSection());

        return $message;
    }
}
