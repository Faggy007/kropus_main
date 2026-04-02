<?php

namespace Modules\Shop\Data\Product;

use Spatie\LaravelData\Data;

class ProductPreview extends Data
{
    public string $slug;

    public string $url;

    public ?string $image;

    public string $title;

    public ?string $description;

    /** @var Attribute[] */
    public array $attributes = [];
}
