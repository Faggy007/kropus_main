<?php

namespace Modules\Shop\Services\UrlService;

use Modules\Common\Services\UrlService\EntityUrlResolver;
use Modules\Shop\Models\ProductVariant;

class ShopProductVariantEntityUrlResolver implements EntityUrlResolver
{
    /**
     * @param mixed|ProductVariant $entity
     */
    public function resolve(mixed $entity): string
    {
        return '/catalog/' . $entity->product->category->slug . '/' . $entity->slug;
    }

}
