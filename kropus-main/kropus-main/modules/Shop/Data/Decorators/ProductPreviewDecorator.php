<?php

namespace Modules\Shop\Data\Decorators;

use Modules\Common\Services\UrlService\UrlService;
use Modules\Shop\Data\Product\ProductPreview;
use Modules\Shop\Models\ModelAttribute;
use Modules\Shop\Models\ProductVariant;

class ProductPreviewDecorator
{
    public function __construct(
        private UrlService                $urlService,
        private ProductAttributeDecorator $attributeDecorator,
    )
    {
    }

    public function decorate(ProductVariant $variant): ProductPreview
    {
        $image = $variant->image ?? $variant->product->image;
        $slug = $variant->slug;
        $url = $this->urlService->entity($variant);
        $title = $variant->getTranslatedField('title');
        $description = $variant->getTranslatedField('description');
        $attributes = $variant->attributes->map(fn(ModelAttribute $model) => $this->attributeDecorator->decorate($model))->all();

        return ProductPreview::from([
            'slug' => $slug,
            'url' => $url,
            'image' => $image,
            'title' => $title,
            'description' => $description,
            'attributes' => $attributes,
        ]);
    }
}
