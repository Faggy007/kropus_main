<?php

namespace Modules\Common\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Builder;
use Modules\Common\Models\PublicStatus;
use Modules\Common\Enums\PublicStatus as PublicStatusEnum;

/**
 * @mixin Model
 * @property PublicStatus $publicStatus
 * @method published()
 * @method publishedOrPrivate()
 * @method draft()
 */
trait HasPublicStatus
{
    public function publicStatus(): MorphOne
    {
        return $this->morphOne(PublicStatus::class, 'model');
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->whereHas('publicStatus', fn(Builder $q) => $q->where('status', PublicStatusEnum::PUBLISHED));
    }

    public function scopePublishedOrPrivate(Builder $query): Builder
    {
        return $query->whereHas('publicStatus', fn(Builder $q) => $q->whereIn('status', [PublicStatusEnum::PUBLISHED, PublicStatusEnum::PRIVATE]));
    }

    public function scopeDraft(Builder $query): Builder
    {
        return $query->whereHas('publicStatus', fn(Builder $q) => $q->where('status', PublicStatusEnum::DRAFT));
    }
}
