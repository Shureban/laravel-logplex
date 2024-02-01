<?php

namespace Shureban\LaravelLogplex\Channels\Slack\Elements;

use Shureban\LaravelLogplex\Channels\Slack\Section;

class HeaderSection implements Section
{
    private string $content;

    /**
     * @param string $content
     */
    public function __construct(string $content)
    {
        $this->content = $content;
    }

    public function toArray(): array
    {
        return [
            "type" => "header",
            "text" => [
                "type"  => "plain_text",
                "text"  => $this->content,
                "emoji" => true,
            ],
        ];
    }
}
