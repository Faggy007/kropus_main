<?php

namespace Modules\Shop\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Modules\Common\Traits\HasMultilingualFields;
use Modules\Common\Traits\HasSeo;
use Modules\Common\Traits\HasSlug;

/**
 * @property int $id
 * @property int|null $category_id
 * @property string $slug
 * @property array|null $title
 * @property array|null $description
 * @property string|null $image
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property-read Category|null $category
 * @property-read Collection|ProductVariant[] $variants
 * @property-read Collection|ModelAttribute[] $attributes
 * @property-read Collection|ModelModifier[] $modifiers
 * @property-read Gallery|null $gallery
 * @property-read Collection|InfoTab[] $infoTabs
 */
class Product extends Model
{
    use HasMultilingualFields, HasSlug, HasSeo;

    protected $table = 'shop_products';

    protected $fillable = [
        'category_id',
        'slug',
        'title',
        'description',
        'image',
    ];

    protected $casts = [
        'title' => 'array',
        'description' => 'array',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function variants(): HasMany
    {
        return $this->hasMany(ProductVariant::class, 'product_id');
    }

    public function attributes(): MorphMany
    {
        return $this->morphMany(ModelAttribute::class, 'model');
    }

    public function modifiers(): MorphMany
    {
        return $this->morphMany(ModelModifier::class, 'model');
    }

    public function gallery(): MorphOne
    {
        return $this->morphOne(Gallery::class, 'model');
    }

    public function infoTabs(): MorphMany
    {
        return $this->morphMany(InfoTab::class, 'model');
    }
}
