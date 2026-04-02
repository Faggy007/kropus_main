<?php

namespace Modules\Shop\Data\Product;

use Spatie\LaravelData\Data;

class ProductFull extends Data
{
    public string $slug;

    public string $url;

    public ?string $image;

    public string $title;

    public ?string $description;

    /** @var ModifierGroup[] */
    public array $modifierGroups = [];

    /** @var Attribute[] */
    public array $attributes = [];

    /** @var GalleryItem[] */
    public array $galleryItems = [];

    public array $infoTabs = [];
}
