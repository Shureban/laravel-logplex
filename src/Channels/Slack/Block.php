<?php

namespace Shureban\LaravelLogplex\Channels\Slack;

use Illuminate\Contracts\Support\Arrayable;

interface Block extends Arrayable
{
    /**
     * @return Section[]
     */
    public function toArray(): array;
}
