<?php

namespace Shureban\LaravelLogplex\Channels\Slack;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Facades\Http;
use Shureban\LaravelLogplex\Channels\Channel;

class SlackChannel implements Channel
{
    private string $url;

    /**
     * @param string $url
     */
    public function __construct(string $url)
    {
        $this->url = $url;
    }

    /**
     * @param Arrayable $message
     *
     * @return void
     */
    public function send(Arrayable $message): void
    {
        $response = Http::timeout(5)
            ->withHeaders([
                'Accept'       => 'application/json',
                'Content-Type' => 'application/json',
            ])
            ->post($this->url, $message->toArray());
        dd($response->body());
    }
}
