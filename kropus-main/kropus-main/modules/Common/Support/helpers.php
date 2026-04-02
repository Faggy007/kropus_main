<?php

use Illuminate\Database\Eloquent\Model;
use Modules\Common\Services\IconService\Icon;
use Modules\Common\Services\IconService\IconService;
use Modules\Common\Services\ThumbnailService\ThumbnailService;
use Modules\Common\Services\UrlService\UrlService;

if (!function_exists('thumbnail')) {
    function thumbnail(): ThumbnailService
    {
        return app(ThumbnailService::class);
    }
}


if (!function_exists('icon')) {
    function icon(string $path): Icon
    {
        $service = app(IconService::class);
        return $service->from($path);
    }
}

if (!function_exists('frontend_url')) {
    function frontend_url(mixed $path = null): UrlService|string
    {
        /** @var UrlService $service */
        $service = app(UrlService::class);

        if ($path === null) {
            return $service;
        }

        if (is_string($path)) {
            return $service->absolute($path);
        }

        if ($path instanceof Model) {
            return $service->entity($path);
        }

        return $service;
    }
}

if (!function_exists('public_url')) {
    function public_url(string $path): string
    {
        return Storage::disk('public')->url($path);
    }
}
