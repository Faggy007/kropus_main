<?php

namespace Modules\Common\Services\IconService;

class IconService
{
    public function from(string $path): ?Icon
    {
        $isRelative = !str_starts_with($path, '/');

        if ($isRelative) {
            return $this->fromRelative($path);
        }
        return $this->fromAbsolute($path);
    }

    public function fromRelative(string $path): ?Icon
    {
        if (!str_ends_with($path, '.svg')) {
            $path .= '.svg';
        }
        return $this->fromAbsolute(public_path('icons/' . $path));
    }

    public function fromAbsolute(string $path): ?Icon
    {
        return Icon::fromPath($path);
    }
}
