<?php

namespace Modules\Shop\Services\ProductVariantSearcher;

use Modules\Shop\Models\ModifierOption;
use Modules\Shop\Models\Product;
use Modules\Shop\Models\ProductVariant;

class Searcher
{
    /**
     * @param ModifierOption[] $options
     */
    public function search(Product $product, array $options = []): ?ProductVariant
    {
        $ids = array_map(fn(ModifierOption $option) => $option->id, $options);
        return ProductVariant::query()->where('product_id', $product->id)->whereHas('modifierOptions', function ($q) use ($ids) {
            $q->whereIn('option_id', $ids);
        }, '=', count($ids)) // проверяем, что совпадает количество найденных
        ->whereDoesntHave('modifierOptions', function ($q) use ($ids) {
            $q->whereNotIn('option_id', $ids);
        }) // исключаем продукты с лишними атрибутами
        ->first();
    }
}
