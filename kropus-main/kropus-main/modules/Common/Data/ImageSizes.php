<?php

namespace Modules\Common\Data;

use Spatie\LaravelData\Data;

class ImageSizes extends Data
{
    public ?string $original;

    public ?string $full;

    public ?string $sm;

    public ?string $sm2x;

    public ?string $md;

    public ?string $md2x;

    public ?string $lg;

    public ?string $lg2x;

    public ?string $xl;

    public ?string $xl2x;

    public ?string $xxl;

    public ?string $xxl2x;

    public ?string $original_webp;

    public ?string $full_webp;

    public ?string $sm_webp;

    public ?string $sm2x_webp;

    public ?string $md_webp;

    public ?string $md2x_webp;

    public ?string $lg_webp;

    public ?string $lg2x_webp;

    public ?string $xl_webp;

    public ?string $xl2x_webp;

    public ?string $xxl_webp;

    public ?string $xxl2x_webp;

    public function toArray(): array
    {
        return [
            'original' => $this->original,
            'full' => $this->full,
            'sm' => $this->sm,
            'sm2x' => $this->sm2x,
            'md' => $this->md,
            'md2x' => $this->md2x,
            'lg' => $this->lg,
            'lg2x' => $this->lg2x,
            'xl' => $this->xl,
            'xl2x' => $this->xl2x,
            'xxl' => $this->xxl,
            'xxl2x' => $this->xxl2x,

            'original_webp' => $this->original_webp,
            'full_webp' => $this->full_webp,
            'sm_webp' => $this->sm_webp,
            'sm2x_webp' => $this->sm2x_webp,
            'md_webp' => $this->md_webp,
            'md2x_webp' => $this->md2x_webp,
            'lg_webp' => $this->lg_webp,
            'lg2x_webp' => $this->lg2x_webp,
            'xl_webp' => $this->xl_webp,
            'xl2x_webp' => $this->xl2x_webp,
            'xxl_webp' => $this->xxl_webp,
            'xxl2x_webp' => $this->xxl2x_webp,
        ];
    }

    public static function fromStore(
        string $path,
        mixed $sm = null,
        mixed $md = null,
        mixed $lg = null,
        mixed $xl = null,
        mixed $xxl = null
    ): self {
        return self::from([
            'original' => url($path),
            'full' => thumbnail()->url($path),
            'sm' => self::resolveSize($path, $sm),
            'sm2x' => self::resolveSize($path, $sm, true),
            'md' => self::resolveSize($path, $md),
            'md2x' => self::resolveSize($path, $md, true),
            'lg' => self::resolveSize($path, $lg),
            'lg2x' => self::resolveSize($path, $lg, true),
            'xl' => self::resolveSize($path, $xl),
            'xl2x' => self::resolveSize($path, $xl, true),
            'xxl' => self::resolveSize($path, $xxl),
            'xxl2x' => self::resolveSize($path, $xxl, true),

            'original_webp' => thumbnail()->url($path, null, null, 'webp'),
            'full_webp' => thumbnail()->url($path, null, null, 'webp'),
            'sm_webp' => self::resolveSize($path, $sm, false, 'webp'),
            'sm2x_webp' => self::resolveSize($path, $sm, true, 'webp'),
            'md_webp' => self::resolveSize($path, $md, false, 'webp'),
            'md2x_webp' => self::resolveSize($path, $md, true, 'webp'),
            'lg_webp' => self::resolveSize($path, $lg, false, 'webp'),
            'lg2x_webp' => self::resolveSize($path, $lg, true, 'webp'),
            'xl_webp' => self::resolveSize($path, $xl, false, 'webp'),
            'xl2x_webp' => self::resolveSize($path, $xl, true, 'webp'),
            'xxl_webp' => self::resolveSize($path, $xxl, false, 'webp'),
            'xxl2x_webp' => self::resolveSize($path, $xxl, true, 'webp'),
        ]);
    }

    public static function fromStoreOneSize(
        string $path,
        mixed $size = null
    ): self {
        return self::from([
            'original' => url($path),
            'full' => thumbnail()->url($path),
            'sm' => self::resolveSize($path, $size),
            'sm2x' => self::resolveSize($path, $size, true),
            'md' => self::resolveSize($path, $size),
            'md2x' => self::resolveSize($path, $size, true),
            'lg' => self::resolveSize($path, $size),
            'lg2x' => self::resolveSize($path, $size, true),
            'xl' => self::resolveSize($path, $size),
            'xl2x' => self::resolveSize($path, $size, true),
            'xxl' => self::resolveSize($path, $size),
            'xxl2x' => self::resolveSize($path, $size, true),

            'original_webp' => thumbnail()->url($path, null, null, 'webp'),
            'full_webp' => thumbnail()->url($path, null, null, 'webp'),
            'sm_webp' => self::resolveSize($path, $size, false, 'webp'),
            'sm2x_webp' => self::resolveSize($path, $size, true, 'webp'),
            'md_webp' => self::resolveSize($path, $size, false, 'webp'),
            'md2x_webp' => self::resolveSize($path, $size, true, 'webp'),
            'lg_webp' => self::resolveSize($path, $size, false, 'webp'),
            'lg2x_webp' => self::resolveSize($path, $size, true, 'webp'),
            'xl_webp' => self::resolveSize($path, $size, false, 'webp'),
            'xl2x_webp' => self::resolveSize($path, $size, true, 'webp'),
            'xxl_webp' => self::resolveSize($path, $size, false, 'webp'),
            'xxl2x_webp' => self::resolveSize($path, $size, true, 'webp'),
        ]);
    }

    private static function resolveSize(
        string $path,
        mixed $size = null,
        bool $isRetina = false,
        ?string $extension = null
    ): string {
        $width = null;
        $height = null;

        if (is_array($size) && count($size) === 1) {
            $size = $size[0];
        }

        if (is_int($size)) {
            $width = $isRetina ? $size * 2 : $size;
        } elseif (is_array($size) && count($size) === 2) {
            $width = $isRetina ? $size[0] * 2 : $size[0];
            $height = $isRetina ? $size[1] * 2 : $size[1];
        }

        return thumbnail()->url($path, $width, $height, $extension);
    }
}
