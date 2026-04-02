<?php

namespace Modules\Shop\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Common\Traits\HasMultilingualFields;
use Modules\Common\Traits\HasSeo;
use Modules\Common\Traits\HasSlug;

/**
 * @property int $id
 * @property array|null $title
 * @property array|null $description
 * @property string $slug
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property-read Collection|Product[] $products
 */
class Category extends Model
{
    use HasMultilingualFields, HasSlug, HasSeo;

    protected $table = 'shop_categories';

    protected $fillable = [
        'title',
        'description',
        'slug',
    ];

    protected $casts = [
        'title' => 'array',
        'description' => 'array',
    ];

    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'category_id');
    }
}
