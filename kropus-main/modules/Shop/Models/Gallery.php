<?php

namespace Modules\Shop\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Gallery
 *
 * @property int $id
 * @property string|null $model_type
 * @property int|null $model_id
 * @property-read Collection<int, GalleryItem> $items
 *
 * @package Modules\Shop\Models
 */
class Gallery extends Model
{
    protected $table = 'shop_gallery';

    protected $fillable = [
        'model_type',
        'model_id',
    ];

    public function items(): HasMany
    {
        return $this->hasMany(GalleryItem::class, 'gallery_id')->orderBy('order');
    }
}
