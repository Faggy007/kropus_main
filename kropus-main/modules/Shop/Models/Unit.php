<?php

namespace Modules\Shop\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Common\Traits\HasMultilingualFields;
use Modules\Common\Traits\HasSlug;

/**
 * @property int $id
 * @property string $slug
 * @property array|null $title
 * @property array|null $short_title
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property-read Collection|Attribute[] $attributes
 */
class Unit extends Model
{
    use HasMultilingualFields, HasSlug;

    protected $table = 'shop_units';

    protected $fillable = [
        'slug',
        'title',
        'short_title',
    ];

    protected $casts = [
        'title' => 'array',
        'short_title' => 'array',
    ];

    public function attributes(): HasMany
    {
        return $this->hasMany(Attribute::class, 'unit_id');
    }
}
