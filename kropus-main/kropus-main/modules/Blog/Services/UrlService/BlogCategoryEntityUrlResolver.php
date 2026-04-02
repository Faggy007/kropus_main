<?php

namespace Modules\Blog\Services\UrlService;

use Modules\Blog\Models\Category;
use Modules\Common\Services\UrlService\EntityUrlResolver;

class BlogCategoryEntityUrlResolver implements EntityUrlResolver
{
    /**
     * @param mixed|Category $entity
     */
    public function resolve(mixed $entity): string
    {
        return $entity->slug;
    }
}
