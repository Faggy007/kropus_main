<?php

namespace Modules\Blog\Services\UrlService;

use Modules\Blog\Models\Post;
use Modules\Common\Services\UrlService\EntityUrlResolver;

class BlogPostEntityUrlResolver implements EntityUrlResolver
{
    /**
     * @param mixed|Post $entity
     */
    public function resolve(mixed $entity): string
    {
        if ($entity->category) {
            return $entity->category->slug . '/' . $entity->slug;
        }

        if ($entity->slug === 'home') {
            return '/';
        }

        return $entity->slug;
    }
}
