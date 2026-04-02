<?php

namespace Modules\Shop\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Modules\Common\Traits\HasMultilingualFields;

/**
 * @property int $id
 * @property int|null $modifier_id
 * @property string $slug
 * @property array|null $title
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property-read Modifier|null $modifier
 */
class ModifierOption extends Model
{
    use HasMultilingualFields;

    protected $table = 'shop_modifier_options';

    protected $fillable = [
        'modifier_id',
        'slug',
        'title',
    ];

    protected $casts = [
        'title' => 'array',
    ];

    public function modifier(): BelongsTo
    {
        return $this->belongsTo(Modifier::class, 'modifier_id');
    }

    public function attributes(): MorphMany
    {
        return $this->morphMany(ModelAttribute::class, 'model');
    }
}
