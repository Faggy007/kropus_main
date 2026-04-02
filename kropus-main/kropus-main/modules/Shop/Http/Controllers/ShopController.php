<?php

namespace Modules\Shop\Http\Controllers;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Contracts\View\View;
use Modules\Shop\Data\Decorators\ProductFullDecorator;
use Modules\Shop\Data\Decorators\ProductPreviewDecorator;
use Modules\Shop\Data\Product\ProductPreview;
use Modules\Shop\Models\Category;
use Modules\Shop\Models\ProductVariant;
use Modules\Shop\Services\Seo\CategorySeoGenerator;
use Modules\Shop\Services\Seo\ProductVariantSeoGenerator;

class ShopController
{
    public function __construct(
        private CategorySeoGenerator $categorySeoGenerator,
        private ProductVariantSeoGenerator $productVariantSeoGenerator,
        private ProductFullDecorator $dataDecorator,
        private ProductPreviewDecorator $previewDataDecorator,
    )
    {
    }

    public function resolve(?string $locale = null, ?string $slug1 = null, ?string $slug2 = null)
    {
        if (!in_array($locale, locales())) {
            $slug2 = $slug1;
            $slug1 = $locale;
        }

        if (
            $slug1 !== null &&
            $slug2 !== null
        ) {
            $variant = ProductVariant::whereSlug($slug2)->whereHas('product', function (Builder $query) use ($slug1) {
                $query->whereHas('category', function (Builder $query) use ($slug1) {
                    $query->where('slug', $slug1);
                });
            })->firstOrFail();

            return $this->variant($variant);
        }

        if ($slug1) {
            $category = Category::whereSlug($slug1)->first();
            if ($category) {
                return $this->category($category);
            }
        }

        abort(404);
    }

    public function category(Category $category): View
    {
        $products = ProductVariant::query()
            ->with(['product', 'product.category'])
            ->whereHas('product', function (Builder $query) use ($category) {
                $query->where('category_id', $category->id);
            })
            ->paginate(12)
            ->through(fn(ProductVariant $variant) => $this->previewDataDecorator->decorate($variant));

        return view('shop.category', [
            'category' => $category,
            'products' => ProductPreview::collect($products),
            'seo' => $this->categorySeoGenerator->generate($category),
        ]);
    }

    public function variant(ProductVariant $variant): View
    {
        $data = $this->dataDecorator->decorate($variant);

        return view('shop.product', [
            'product' => $variant,
            'data' => $data,
            'seo' => $this->productVariantSeoGenerator->generate($variant),
        ]);
    }
}
