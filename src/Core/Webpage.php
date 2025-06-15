<?php

namespace Gewoehnlich\Umarket\Core;

use Symfony\Component\Panther\Client;

final class Webpage
{
    final public static function fetch(string $url): string
    {
        $client = Client::createChromeClient();

        $response = $client->request('GET', 'https://nowsecure.nl');

        $html = $client->getPageSource();

        file_put_contents('test.html', $html);

        die();

        return $url;
    }
}
