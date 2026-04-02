<?php

namespace Modules\Shop\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Common\Traits\HasMultilingualFields;
use Modules\Common\Traits\HasSlug;

/**
 * @property int $id
 * @property string $slug
 * @property AttributeType $type
 * @property array|null $title
 * @property int|null $unit_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property-read Unit|null $unit
 * @property-read Collection|AttributeOption[] $options
 */
class Attribute extends Model
{
    use HasMultilingualFields, HasSlug;

    protected $table = 'shop_attributes';

    protected $fillable = [
        'slug',
        'type',
        'title',
        'unit_id',
    ];

    protected $casts = [
        'title' => 'array',
        'type' => AttributeType::class
    ];

    public function unit(): BelongsTo
    {
        return $this->belongsTo(Unit::class, 'unit_id');
    }

    public function options(): HasMany
    {
        return $this->hasMany(AttributeOption::class, 'attribute_id');
    }
}
