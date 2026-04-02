<?php

namespace Modules\Common\Services\UrlService;

class UrlService
{
    public function __construct(
        protected EntityUrlResolver $entityUrlResolver,
    )
    {
    }

    public function entity(mixed $entity): string
    {
        return $this->absolute($this->entityUrlResolver->resolve($entity));
    }

    public function home(): string
    {
        return $this->base();
    }

    public function absolute(string $path): string
    {
        return $this->base() . $this->normalizePath($path);
    }

    public function base(): string
    {
        $url = config('app.url');
        if (str_ends_with($url, '/')) {
            $url = substr($url, 0, -1);
        }
        return $url . $this->locale();
    }

    protected function locale(): string
    {
        $current = locale();
        $isDefault = $current === config('app.main_locale');

        return $isDefault ? '' : '/' . $current;
    }

    protected function normalizePath(string $path): string
    {
        if (!str_starts_with($path, '/')) {
            $path = '/' . $path;
        }
        return $path;
    }
}
