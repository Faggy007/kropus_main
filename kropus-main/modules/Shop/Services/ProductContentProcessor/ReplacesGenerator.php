<?php

namespace Modules\Shop\Services\ProductContentProcessor;

use Modules\Shop\Models\Product;
use Modules\Shop\Models\ProductVariant;
use Modules\Shop\Services\AttributeValueHumanizer\Humanizer as AttributeValueHumanizer;

class ReplacesGenerator
{
    public function __construct(
        private AttributeValueHumanizer $attributeValueHumanizer,
    )
    {
    }

    public function generate(
        Product|ProductVariant $product,
        ?string $locale = null
    ): array
    {
        $rootProduct = $product instanceof ProductVariant ? $product->product : $product;

        $replaces = [
            '{product:title}' => $rootProduct->getTranslatedField('title', '', $locale),
        ];

        foreach ($product->attributes as $attribute) {
            $key = '{attribute:' . $attribute->attribute->slug . '}:value';
            $value = $this->attributeValueHumanizer->humanize($attribute, true, $locale);
            $replaces[$key] = $value;

            $key = '{attribute:' . $attribute->attribute->slug . '}:title';
            $value = $attribute->attribute->getTranslatedField('title', '', $locale);
            $replaces[$key] = $value;
        }

        foreach ($rootProduct->modifiers as $modifier) {
            $key = '{modifier:' . $modifier->modifier->slug . '}:title';
            $value = $modifier->modifier->getTranslatedField('title', '', $locale);
            $replaces[$key] = $value;
        }

        return $replaces;
    }
}
