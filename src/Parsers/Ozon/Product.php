<?php

namespace Gewoehnlich\Umarket\Parsers\Ozon;

use Symfony\Component\DomCrawler\Crawler;
use Gewoehnlich\Umarket\Core\Parser;

final class Product extends Parser
{
    private array $data = [];
    private Crawler $crawler;

    public function __construct(string $webpage)
    {
        $this->data = [
            'Название'            => '',
            'Категория'           => '',
            'Тип'                 => '',
            'Страна'              => '',
            'Партномер'           => '',
            'Страна-изготовитель' => '',
            'Изображения'         => '',
            'Описание'            => '',
            'Характеристики'      => '',
        ];

        $this->crawler = new Crawler($webpage);
    }

    final public static function parse(string $webpage): array
    {
        $product = new Product($webpage);

        $product->title();
        $product->category();
        $product->type();
        $product->country();
        $product->sku();
        $product->manufacturer();
        $product->images();
        $product->description();
        $product->characteristics();

        return $product->data;
    }

    private function title(): void
    {
        $title = $this->crawler->filter('div[data-widget="webProductHeading"] h1')->text();

        $this->data['Название'] = $title;
    }

    private function category(): void
    {
        $category = $this->crawler
            ->filter('div[data-widget="breadCrumbs"] li')
            ->each(function (Crawler $node) {
                return $node->text();
            });

        $this->data['Категория'] = $category;
    }

    private function type(): void
    {
        $this->data['Тип'] = '';
    }

    private function country(): void
    {
        $this->data['Страна'] = '';
    }

    private function sku(): void
    {
        $this->data['Партномер'] = '';
    }

    private function manufacturer(): void
    {
        $this->data['Страна-изготовитель'] = '';
    }

    private function images(): void
    {
        $this->data['Изображения'] = '';
    }

    private function description(): void
    {
        $this->data['Описание'] = '';
    }

    private function characteristics(): void
    {
        $this->data['Характеристики'] = '';
    }
}
