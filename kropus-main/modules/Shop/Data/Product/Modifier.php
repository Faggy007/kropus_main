<?php

namespace Modules\Shop\Data\Product;

use Spatie\LaravelData\Data;

class Modifier extends Data
{
    public string $title;

    public string $url;
    public bool $isActive;
}
