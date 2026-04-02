<?php

namespace Modules\Common\Services\ThumbnailService;

use Illuminate\Support\Facades\Storage;
use Modules\Common\Jobs\ResizeImage;

class OnDemandThumbnailService implements ThumbnailService
{
    public function get(
        string $path,
        ?int $width = null,
        ?int $height = null,
        ?string $extension = null
    ): string {
        $disk = Storage::disk('public');

        if (! $disk->exists($path)) {
            return $path;
        }

        $widthString = $width ? (string) $width : '0';
        $heightString = $height ? (string) $height : '0';
        $pathExtension = pathinfo($path, PATHINFO_EXTENSION);
        $newPath = str_replace('.'.$pathExtension, '', $path).'.'.($extension ?? $pathExtension);

        $resizedPath =
            'attachments-resized'.
            DIRECTORY_SEPARATOR.
            $widthString.
            'x'.
            $heightString.
            DIRECTORY_SEPARATOR.
            $newPath;

        if (! $disk->exists($resizedPath)) {
            ResizeImage::dispatch($path, $resizedPath, 'public', $width, $height);
        }

        return $resizedPath;
    }

    public function url(string $path, ?int $width = null, ?int $height = null, ?string $extension = null): string
    {
        return url(Storage::url($this->get($path, $width, $height, $extension)));
    }
}
