<?php

namespace Modules\Shop\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * @property int $id
 * @property string $model_type
 * @property int $model_id
 * @property int|null $modifier_id
 * @property int|null $order
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property-read Model|Product|ProductVariant $model
 * @property-read Modifier|null $modifier
 */
class ModelModifier extends Model
{
    protected $table = 'shop_model_modifiers';

    protected $fillable = [
        'model_type',
        'model_id',
        'modifier_id',
        'order',
    ];

    public function model(): MorphTo
    {
        return $this->morphTo();
    }

    public function modifier(): BelongsTo
    {
        return $this->belongsTo(Modifier::class, 'modifier_id');
    }
}
