<?php

namespace Gewoehnlich\Umarket\DTO\Ozon;

use Gewoehnlich\Umarket\DTO\DTO;

final class ProductDTO extends DTO
{
    public readonly string $title;
    public readonly array $category;
    public readonly string $type;
    public readonly string $country;
    public readonly int $sku;
    public readonly string $manufacturer;
    public readonly array $images;
    public readonly string $description;
    public readonly string $characteristics;

    public function __construct(
        string $title,
        array $category,
        string $type,
        string $country,
        int $sku,
        string $manufacturer,
        array $images,
        string $description,
        string $characteristics
    ) {
        $this->title = $title;
        $this->category = $category;
        $this->type = $type;
        $this->country = $country;
        $this->sku = $sku;
        $this->manufacturer = $manufacturer;
        $this->images = $images;
        $this->description = $description;
        $this->characteristics = $characteristics;
    }

    public function __toArray(): array
    {
        return [
            'Название'            => $this->title,
            'Категория'           => $this->category,
            'Тип'                 => $this->type,
            'Страна'              => $this->country,
            'Партномер'           => $this->sku,
            'Страна-изготовитель' => $this->manufacturer,
            'Изображения'         => $this->images,
            'Описание'            => $this->description,
            'Характеристики'      => $this->characteristics,
        ];
    }
}
