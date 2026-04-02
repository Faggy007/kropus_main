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
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property-read Collection|ModifierOption[] $options
 */
class Modifier extends Model
{
    use HasMultilingualFields, HasSlug;

    protected $table = 'shop_modifiers';

    protected $fillable = [
        'slug',
        'title',
    ];

    protected $casts = [
        'title' => 'array',
    ];

    public function options(): HasMany
    {
        return $this->hasMany(ModifierOption::class, 'modifier_id');
    }
}
