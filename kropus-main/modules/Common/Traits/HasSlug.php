<?php

namespace Modules\Common\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * @method static whereSlug(string $slug)
 */
trait HasSlug
{
    protected static function bootHasSlug()
    {
        static::creating(function (Model $model) {
            if ($model->slug === null) {
                $slug = $originSlug = str($model->slugFrom())->slug();

                $version = 1;
                while (static::query()->where('slug', $slug)->exists()) {
                    $slug = str($originSlug)->append('-' . $version)->slug();
                    $version++;
                }

                $model->slug = $slug;
            }
        });
    }

    public function slugFrom(): string
    {
        return $this->title ?? Str::random();
    }

    public function scopeWhereSlug(Builder $query, string $slug): Builder
    {
        return $query->where('slug', $slug);
    }
}
