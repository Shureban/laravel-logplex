<?php

namespace Shureban\LaravelLogplex\Channels\Slack\Elements;

use Shureban\LaravelLogplex\Channels\Slack\Section;

class FieldsSection implements Section
{
    private array $fields;

    /**
     * @param array $fields
     */
    public function __construct(array $fields)
    {
        $this->fields = $fields;
    }

    public function toArray(): array
    {
        $fields = array_map(fn(string $textLine) => ["text" => $textLine, "type" => 'mrkdwn'], $this->fields);

        return [
            "type"   => "section",
            "fields" => $fields,
        ];
    }
}
