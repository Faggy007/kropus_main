<?php

namespace Modules\Common\Services\UrlService;

use RuntimeException;

class InstanceEntityUrlResolver implements EntityUrlResolver
{
    public function __construct(
        /**  @var array<string, EntityUrlResolver> */
        protected array $entitiesResolverMapping,
    ) {
    }

    public function resolve(mixed $entity): string
    {
        foreach ($this->entitiesResolverMapping as $class => $url) {
            if ($entity instanceof $class) {
                return $url->resolve($entity);
            }
        }

        throw new RuntimeException('No resolver found for entity: ' . get_class($entity));
    }
}
