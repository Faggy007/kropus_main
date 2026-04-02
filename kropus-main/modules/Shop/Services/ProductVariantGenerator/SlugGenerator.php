<?php

namespace Modules\Shop\Services\ProductVariantGenerator;

use Modules\Shop\Models\ModifierOption;
use Modules\Shop\Models\Product;

class SlugGenerator
{
    /**
     * @param Product $product
     * @param ModifierOption[] $options
     * @return string
     */
    public function generate(Product $product, array $options = []): string
    {
        return implode('-', [
            $product->slug,
            ...array_map(fn(ModifierOption $option) => $option->slug, $options),
        ]);
    }
}
