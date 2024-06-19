<?php

namespace Shureban\LaravelLogplex\Channels\Slack;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
use JsonSerializable;

class Message implements Arrayable, Jsonable, JsonSerializable
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

    /**
     * @param int $options
     *
     * @return string
     */
    public function toJson($options = 0): string
    {
        return json_encode($this->toArray(), $options);
    }

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return $this->toArray();
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'username'   => $this->username,
            'blocks'     => $this->blocks,
            'icon_emoji' => $this->iconEmoji,
        ];
    }
}
