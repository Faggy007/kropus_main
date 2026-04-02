<?php

namespace Modules\Shop\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Modules\Common\Traits\HasMultilingualFields;

/**
 * @property int $id
 * @property string $model_type
 * @property int $model_id
 * @property int|null $attribute_id
 * @property int|null $option_id
 * @property array|null $text_value
 * @property float|null $numeric_value
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property-read Model|Product|ProductVariant $model
 * @property-read Attribute|null $attribute
 * @property-read AttributeOption|null $option
 */
class ModelAttribute extends Model
{
    use HasMultilingualFields;

    protected $table = 'shop_model_attributes';

    protected $fillable = [
        'model_type',
        'model_id',
        'attribute_id',
        'option_id',
        'text_value',
        'numeric_value',
    ];

    protected $casts = [
        'text_value' => 'array',
    ];

    public function model(): MorphTo
    {
        return $this->morphTo();
    }

    public function attribute(): BelongsTo
    {
        return $this->belongsTo(Attribute::class, 'attribute_id');
    }

    public function option(): BelongsTo
    {
        return $this->belongsTo(AttributeOption::class, 'option_id');
    }
}
