<?php

namespace Gewoehnlich\Umarket\Scrapers;

use Gewoehnlich\Umarket\Core\WebScraper;
use Gewoehnlich\Umarket\Core\Webpage;
use Gewoehnlich\Umarket\Parsers\Ozon\Product;

abstract final class OzonScraper extends WebScraper
{
    final public static function handle(string $url): array
    {
        if (str_contains($url, 'www.ozon.ru/product')) {
            return OzonScraper::product($url);
        }

        return [
            'success' => false,
            'message' => 'Неподдерживаемая категория для скрейпинга.',
            'url'     => $url
        ];
    }

    final private static function product(string $url): array
    {
        $webpage = Webpage::fetch($url);

        return Product::parse($webpage);
    }
}
