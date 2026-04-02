<?php

namespace Modules\Calculator\Data;

use Illuminate\Support\Collection;
use Spatie\LaravelData\Data;

class Model extends Data
{
    public Collection $elements;
    public function __construct(
        public int $width,
        public int $height,
        public int $depth,
    )
    {
        $this->elements = new Collection();
    }
}
