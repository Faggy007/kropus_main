<?php

namespace App\Livewire;

use Livewire\Attributes\Locked;
use Livewire\Component;
use Modules\Shop\Data\Decorators\ProductPreviewDecorator;
use Modules\Shop\Models\Product;
use Modules\Shop\Models\ProductVariant;

class RelatedProductsCatalog extends Component
{
    public function render()
    {
        $products = Product::query()
            ->whereHas('variants')
            ->get();

        return view('livewire.related-products-catalog', ['products' => $products]);
    }
}
