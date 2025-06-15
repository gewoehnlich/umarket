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
            ->filter('div[id="section-characteristics"]')
            ->filterXPath('//dt[span[contains(text(), "Тип")]]/following-sibling::dd[1]')
            ->text();
    }

    private function country(): string
    {
        return $this->crawler
            ->filter('div[id="section-characteristics"]')
            ->filterXPath('//dt[span[contains(text(), "Страна")]]/following-sibling::dd[1]')
            ->text();
    }

    private function sku(): int
    {
        return $this->crawler
            ->filter('div[id="section-characteristics"]')
            ->filterXPath('//dt[span[contains(text(), "Артикул")]]/following-sibling::dd[1]')
            ->text();
    }

    private function manufacturer(): string
    {
        return $this->crawler
            ->filter('div[id="section-characteristics"]')
            ->filterXPath('//dt[span[contains(text(), "Страна-изготовитель")]]/following-sibling::dd[1]')
            ->text();
    }

    private function images(): array
    {
        return $this->crawler
            ->filter('div[data-widget="webGallery"] img')
            ->each(function (Crawler $node) {
                $node->text();
            });
    }

    private function description(): string
    {
        return $this->crawler
            ->filter('div[id="section-description"] > div:nth-child(2)')
            ->text();
    }

    private function characteristics(): array
    {
        $result = [];

        $this->crawler
            ->filter('div[id="section-characteristics"] dl')
            ->each(function (Crawler $node) use (&$result) {
                $label = $node->filter('dt')->text(null, true);
                $valueNode = $node->filter('dd');

                $valueParts = $valueNode->filterXPath('//dd//text() | //dd//a')->each(
                    fn(Crawler $part) => trim($part->text(null, true))
                );

                $value = implode(', ', array_filter($valueParts));

                $result[$label] = $value;
            });

        return $result;
    }
}
