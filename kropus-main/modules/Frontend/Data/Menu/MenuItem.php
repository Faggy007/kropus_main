<?php

namespace Modules\Frontend\Data\Menu;

use Spatie\LaravelData\Data;

class MenuItem extends Data
{
    use HasItems;

    public function __construct(
        public string $name,
        public string $url,
    )
    {
    }
}
