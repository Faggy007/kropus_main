<?php

namespace Modules\Common\Data;

use Spatie\LaravelData\Data;

class Seo extends Data
{
    public string $title;

    public ?string $description = null;

    public ?string $image = null;

    public ?string $robots = null;
    public ?string $canonical = null;

    public function nonIndexable(): static
    {
        $this->robots = 'noindex, follow';

        return $this;
    }
}
