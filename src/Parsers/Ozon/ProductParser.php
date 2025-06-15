<?php

namespace Gewoehnlich\Umarket\Parsers\Ozon;

use Symfony\Component\DomCrawler\Crawler;
use Gewoehnlich\Umarket\Core\Parser;
use Gewoehnlich\Umarket\DTO\Ozon\ProductDTO;

final class ProductParser extends Parser
{
    private array $data = [];
    private Crawler $crawler;

    public function __construct(string $webpage)
    {
        $this->crawler = new Crawler($webpage);
    }

    final public static function parse(string $webpage): array
    {
        $product = new ProductParser($webpage);

        $dto = new ProductDTO(
            title:           $product->title(),
            category:        $product->category(),
            type:            $product->type(),
            country:         $product->country(),
            sku:             $product->sku(),
            manufacturer:    $product->manufacturer(),
            images:          $product->images(),
            description:     $product->description(),
            characteristics: $product->characteristics(),
        );

        return (array) $dto;
    }

    private function title(): string
    {
        return $this->crawler->filter('div[data-widget="webProductHeading"] h1')->text();
    }

    private function category(): array
    {
        return $this->crawler
            ->filter('div[data-widget="breadCrumbs"] li')
            ->each(function (Crawler $node) {
                return $node->text();
            });
    }

    private function type(): string
    {
        return $this->crawler
            ->filter('div[data-widget="webShortCharacteristics"] ' .
                '> div:nth-of-type(2) ' .
                '> div:first-child ' .
                '> div:last-child span')
            ->text();
    }

    private function country(): string
    {
        return $this->crawler
            ->filter('div[id="section-characteristics"]')
            ->text();
            // ->filterXPath('//*[contains(text(), "Страна")]/..')
            // ->last()
            // ->text();
    }

    private function sku(): int
    {
        return 0;
    }

    private function manufacturer(): string
    {
        return '';
    }

    private function images(): array
    {
        return [];
    }

    private function description(): string
    {
        return '';
    }

    private function characteristics(): string
    {
        return '';
    }
}
