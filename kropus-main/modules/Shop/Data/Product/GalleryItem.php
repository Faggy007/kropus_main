<?php

namespace Modules\Shop\Data\Product;

use InvalidArgumentException;
use Spatie\LaravelData\Data;
use Modules\Shop\Models\GalleryItem as GalleryItemModel;

class GalleryItem extends Data
{
    public string $type;

    public string $previewImage;

    public ?string $image = null;

    public ?string $video = null;

    public ?string $iframe = null;

    public static function fromModel(GalleryItemModel $model): self
    {
        if ($model->type === 'image') {
            return self::from([
                'type' => 'image',
                'previewImage' => $model->preview_image ?? $model->image,
                'image' => $model->image,
            ]);
        } elseif ($model->type === 'video') {
            return self::from([
                'type' => 'video',
                'previewImage' => $model->preview_image,
                'video' => $model->video,
            ]);
        } elseif ($model->type === 'iframe') {
            return self::from([
                'type' => 'iframe',
                'previewImage' => $model->preview_image,
                'iframe' => $model->iframe,
            ]);
        } else {
            throw new InvalidArgumentException("Unknown gallery item type: {$model->type}");
        }
    }
}
