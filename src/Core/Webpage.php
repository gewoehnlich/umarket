<?php

namespace Gewoehnlich\Umarket\Core;

use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

final class Webpage
{
    final public static function fetch(string $url): string
    {
        $process = new Process(['python', 'src/Webpage/fetch.py', $url]);
        $process->run();

        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        $html = $process->getOutput();

        file_put_contents("public/ozon.html", $html);

        return $html;
    }
}
