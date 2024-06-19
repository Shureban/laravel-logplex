<?php

namespace Shureban\LaravelLogplex\Channels;

use Illuminate\Contracts\Support\Arrayable;

interface Channel
{
    public function send(Arrayable $message): void;
}
