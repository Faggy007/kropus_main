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
 * @property int|null $option_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property-read Model|ProductVariant $model
 * @property-read ModifierOption|null $option
 */
class ModelModifierOption extends Model
{
    protected $table = 'shop_model_modifier_options';

    protected $fillable = [
        'model_type',
        'model_id',
        'option_id',
    ];

    public function model(): MorphTo
    {
        return $this->morphTo();
    }

    public function option(): BelongsTo
    {
        return $this->belongsTo(ModifierOption::class, 'option_id');
    }
}
