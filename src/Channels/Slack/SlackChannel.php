<?php

namespace Shureban\LaravelLogplex\Channels\Slack;

use App\Components\Http\Client;
use GuzzleHttp\Exception\GuzzleException;
use Shureban\LaravelLogplex\Channels\Channel;
use Shureban\LaravelLogplex\Channels\Slack\Blocks\FileBlock;
use Shureban\LaravelLogplex\Channels\Slack\Blocks\HeaderBlock;
use Shureban\LaravelLogplex\Channels\Slack\Blocks\TraceBlock;
use Shureban\LaravelLogplex\Channels\Slack\Blocks\UserBlock;
use Shureban\LaravelLogplex\Channels\Slack\Elements\DividerSection;
use Shureban\LaravelLogplex\LogRecord;

class SlackChannel implements Channel
{
    private string $url;
    private string $username;
    private string $emoji;
    private Client $client;

    /**
     * @param string      $url
     * @param string      $username
     * @param string|null $emoji
     */
    public function __construct(string $url, string $username, string $emoji = null)
    {
        $this->url      = $url;
        $this->username = $username;
        $this->emoji    = $emoji;
        $this->client   = new Client([
            'timeout' => 5,
            'headers' => [
                'Accept'       => 'application/json',
                'Content-Type' => 'application/json',
            ],
        ], false);
    }

    /**
     * @param LogRecord $logRecord
     *
     * @return void
     * @throws GuzzleException
     */
    public function send(LogRecord $logRecord): void
    {
        $header  = new HeaderBlock($logRecord);
        $user    = new UserBlock($logRecord);
        $file    = new FileBlock($logRecord);
        $trace   = new TraceBlock($logRecord);
        $message = new Message($this->username, $this->emoji);

        $message->addBlock($header);
        $message->addBlock($user);
        $message->addBlock($file);
        $message->addBlock($trace);
        $message->addSection(new DividerSection());

        $response = $this->client->post($this->url, $message);
        //        dd($response->getBody()->getContents());
    }
}
