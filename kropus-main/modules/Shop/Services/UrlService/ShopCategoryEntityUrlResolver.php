<?php

namespace Modules\Shop\Services\UrlService;

use Modules\Common\Services\UrlService\EntityUrlResolver;
use Modules\Shop\Models\Category;

class ShopCategoryEntityUrlResolver implements EntityUrlResolver
{
    /**
     * @param mixed|Category $entity
     */
    public function resolve(mixed $entity): string
    {
        return '/catalog/' . $entity->slug;
    }

}
