<?php

namespace Shureban\LaravelLogplex\Channels\Slack\Elements;

use Shureban\LaravelLogplex\Channels\Slack\Section;

class DividerSection implements Section
{
    public function toArray(): array
    {
        return [
            "type" => "divider",
        ];
    }
}
