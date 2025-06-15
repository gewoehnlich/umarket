<?php

namespace Gewoehnlich\Umarket\Core;

use Gewoehnlich\Umarket\Scrapers\OzonScraper;

abstract class WebScraper
{
    public static function handle(string $url): array
    {
        if (str_contains($url, 'www.ozon.ru')) {
            return OzonScraper::handle($url);
        }

        return [
            'success' => false,
            'message' => 'Неподдерживаемый вебсайт для скрейпинга.',
            'url'     => $url
        ];
    }
}
