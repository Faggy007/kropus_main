<?php

namespace Modules\Common\Services\ThumbnailService;

interface ThumbnailService
{
    public function get(string $path, ?int $width = null, ?int $height = null, ?string $extension = null): string;

    public function url(string $path, ?int $width = null, ?int $height = null, ?string $extension = null): string;
}
