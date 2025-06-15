<?php

namespace Gewoehnlich\Umarket\Core;

abstract class Parser
{
    public static function parse(string $webpage): array
    {
        return [
            'webpage' => $webpage
        ];
    }
}
