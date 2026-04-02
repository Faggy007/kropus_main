<?php

namespace Modules\Shop\Services\ProductVariantGenerator;

use Modules\Shop\Models\ModifierOption;
use Modules\Shop\Models\Product;

class TitleGenerator
{
    /**
     * @param Product $product
     * @param ModifierOption[] $options
     * @param string|null $locale
     * @return string
     */
    public function generate(Product $product, array $options = [], ?string $locale = null): string
    {
        return implode(' ', [
            $product->getTranslatedField('title', '', $locale),
            ...array_map(fn(ModifierOption $option) => $option->getTranslatedField('title', '', $locale), $options),
        ]);
    }
}
