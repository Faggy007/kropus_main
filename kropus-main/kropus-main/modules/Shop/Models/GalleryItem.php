<?php

namespace Modules\Shop\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

/**
 * Class GalleryItem
 *
 * @property int $id
 * @property int $gallery_id
 * @property string|null $type
 * @property string|null $image
 * @property string|null $preview_image
 * @property string|null $video
 * @property string|null $iframe
 * @property int|null $order
 *
 * @package Modules\Shop\Models
 */
class GalleryItem extends Model implements Sortable
{
    use SortableTrait;

    protected $table = 'shop_gallery_items';

    protected $fillable = [
        'gallery_id',
        'type',
        'image',
        'preview_image',
        'video',
        'iframe',
        'order',
    ];
}
