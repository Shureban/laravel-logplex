<?php

namespace Shureban\LaravelLogplex\Channels\Slack;

use App\Components\Http\JsonRequest;

class Message extends JsonRequest
{

    private string $username;
    private string $iconEmoji;
    private array  $blocks = [];

    /**
     * @param string $username
     * @param string $iconEmoji
     */
    public function __construct(string $username, string $iconEmoji)
    {
        $this->username  = $username;
        $this->iconEmoji = $iconEmoji;
    }

    public function addBlock(Block $block): void
    {
        $this->blocks = array_merge($this->blocks, $block->toArray());
    }

    public function addSection(Section $section): void
    {
        $this->blocks[] = $section->toArray();
    }

    public function toArray(): array
    {
        return [
            'username'   => $this->username,
            'blocks'     => $this->blocks,
            'icon_emoji' => $this->iconEmoji,
        ];
    }
}
