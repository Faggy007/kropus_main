<?php

namespace App\Livewire;

use Livewire\Attributes\Locked;
use Livewire\Component;
use Modules\Shop\Data\Decorators\ProductPreviewDecorator;
use Modules\Shop\Models\ProductVariant;

class RelatedProducts extends Component
{
    public string $title = 'Похожие товары';

    public bool $animate = false;

    public string|array $products = [];
    public string|array $categories = [];

    public array $exceptIds = [];

    public ?string $sortBy = 'created_at';
    public string $sort = 'desc';

    #[Locked]
    public int $count = 12;

    public string $type = 'slider';

    protected ProductPreviewDecorator $dataDecorator;

    public function boot(ProductPreviewDecorator $dataDecorator)
    {
        $this->dataDecorator = $dataDecorator;
    }

    public function render()
    {
        $variants = ProductVariant::query()
            ->with(['product', 'product.category'])
            ->when(fn() => !empty($this->categories), fn($query) => $query->whereHas('product.category', function ($query) {
                $query->whereIn('slug', (array)$this->categories);
            }))
            ->when(fn() => !empty($this->products), fn($query) => $query->whereHas('product', function ($query) {
                $query->whereIn('slug', (array)$this->products);
            }))
            ->when(fn() => !empty($this->exceptIds), fn($query) => $query->whereNotIn('id', $this->exceptIds))
            ->orderBy($this->sortBy, $this->sort)
            ->limit($this->count)
            ->get()
            ->map(fn(ProductVariant $variant) => $this->dataDecorator->decorate($variant));

        return view('livewire.related-products', ['variants' => $variants]);
    }
}
