<?php

use Monolog\Level;
use Shureban\LaravelLogplex\Builder\MessageBuilder;

return [
    /*
    |--------------------------------------------------------------------------
    | Logplex Webhook URL
    |--------------------------------------------------------------------------
    |
    | The URL to your Logplex webhook. This is used to send logging data
    | directly from your Laravel application to the Slack channel.
    |
    */
    'webhook_url'     => env('LOGPLEX_WEBHOOK_URL'),

    /*
    |--------------------------------------------------------------------------
    | Logplex Username
    |--------------------------------------------------------------------------
    |
    | The username that will be used when sending data to Slack.
    | This is typically the name of your Laravel application.
    |
    */
    'username'        => env('LOGPLEX_USERNAME'),

    /*
    |--------------------------------------------------------------------------
    | Logplex Emoji
    |--------------------------------------------------------------------------
    |
    | The emoji that will be used in Logplex messages. This can
    | be used to visually distinguish different message types.
    |
    */
    'emoji'           => env('LOGPLEX_EMOJI'),

    /*
    |--------------------------------------------------------------------------
    | Logplex Logging Level
    |--------------------------------------------------------------------------
    |
    | The level of logging details to be sent to Logplex.
    | This can be set to control the verbosity of your logs.
    |
    */
    'level'           => env('LOGPLEX_LEVEL', Level::Error),

    /*
    |--------------------------------------------------------------------------
    | Logplex Message Builder
    |--------------------------------------------------------------------------
    |
    | The class that is responsible for building your Logplex messages.
    | By default, the provided MessageBuilder class is used.
    |
    */
    'message_builder' => MessageBuilder::class,
];
