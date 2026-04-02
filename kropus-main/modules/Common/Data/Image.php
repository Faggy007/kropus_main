<?php

namespace Modules\Common\Data;

use Spatie\LaravelData\Data;

class Image extends Data
{
    public ?string $alt = null;

    public function __construct(
        public ImageSizes $sizes,
    )
    {
    }

    public function alt(?string $alt): self
    {
        $this->alt = $alt;
        return $this;
    }

    public static function fromSizes(
        string $path,
        mixed $sm = null,
        mixed $md = null,
        mixed $lg = null,
        mixed $xl = null,
        mixed $xxl = null
    ): self
    {
        return new self(ImageSizes::fromStore($path, $sm, $md, $lg, $xl, $xxl));
    }

    public static function fromOneSize(
        string $path,
        mixed $size = null,
    ): self
    {
        return new self(ImageSizes::fromStoreOneSize($path, $size));
    }
}
