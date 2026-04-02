<?php

namespace Modules\Shop\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Common\Traits\HasMultilingualFields;
use Modules\Common\Traits\HasSlug;

/**
 * @property int $id
 * @property int|null $attribute_id
 * @property string $slug
 * @property array|null $title
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property-read Attribute|null $attribute
 */
class AttributeOption extends Model
{
    use HasMultilingualFields, HasSlug;

    protected $table = 'shop_attribute_options';

    protected $fillable = [
        'attribute_id',
        'slug',
        'title',
    ];

    protected $casts = [
        'title' => 'array',
    ];

    public function attribute(): BelongsTo
    {
        return $this->belongsTo(Attribute::class, 'attribute_id');
    }
}
