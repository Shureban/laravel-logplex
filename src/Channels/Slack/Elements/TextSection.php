<?php

namespace Shureban\LaravelLogplex\Channels\Slack\Elements;

use Shureban\LaravelLogplex\Channels\Slack\Section;

class TextSection implements Section
{
    private string $content;
    private string $type;

    /**
     * @param string $content
     * @param string $type
     */
    public function __construct(string $content, string $type = 'mrkdwn')
    {
        $this->content = $content;
        $this->type    = $type;
    }

    public function toArray(): array
    {
        return [
            "type" => "section",
            "text" => [
                "text" => $this->content,
                "type" => $this->type,
            ],
        ];
    }
}
