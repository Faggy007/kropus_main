<?php

namespace Modules\Shop\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Modules\Common\Traits\HasMultilingualFields;
use Modules\Common\Traits\HasPublicStatus;
use Modules\Common\Traits\HasSlug;

/**
 * @property int $id
 * @property string|null $slug
 * @property int|null $product_id
 * @property array|null $title
 * @property array|null $description
 * @property string|null $image
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property-read Product|null $product
 * @property-read Collection|ModelAttribute[] $attributes
 * @property-read Collection|ModelModifierOption[] $modifierOptions
 */
class ProductVariant extends Model
{
    use HasMultilingualFields, HasSlug, HasPublicStatus;

    protected $table = 'shop_product_variants';

    protected $fillable = [
        'product_id',
        'slug',
        'title',
        'description',
        'image',
    ];

    protected $casts = [
        'title' => 'array',
        'description' => 'array',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function attributes(): MorphMany
    {
        return $this->morphMany(ModelAttribute::class, 'model');
    }

    public function modifierOptions(): MorphMany
    {
        return $this->morphMany(ModelModifierOption::class, 'model');
    }

    public function slugFrom(): string
    {
        return $this->getTranslatedField('title');
    }
}
