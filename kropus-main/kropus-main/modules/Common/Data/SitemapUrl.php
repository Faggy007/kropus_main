<?php

namespace Modules\Common\Data;

use Spatie\LaravelData\Data;

class SitemapUrl extends Data
{
    public function __construct(
        public string $url,
        public string $name,
        public string $frequency,
        public float $priority,
        public string $lang,
    ) {}
}
