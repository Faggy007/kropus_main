<?php

namespace Modules\Shop\Services\ProductContentProcessor;

use Modules\Shop\Models\Product;
use Modules\Shop\Models\ProductVariant;

class Processor
{
    public function __construct(
        private ReplacesGenerator $replacesGenerator,
    )
    {
    }

    public function process(
        Product|ProductVariant $product,
        string $content,
        ?string $locale = null
    ): string
    {
        $replaces = $this->replacesGenerator->generate($product, $locale);

        return str_replace(
            array_keys($replaces),
            array_values($replaces),
            $content
        );
    }
}
