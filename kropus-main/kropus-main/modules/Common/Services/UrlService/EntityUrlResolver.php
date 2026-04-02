<?php

namespace Modules\Common\Services\UrlService;

interface EntityUrlResolver
{
    public function resolve(mixed $entity): string;
}
