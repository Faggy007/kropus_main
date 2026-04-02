<?php

namespace Modules\Common\Traits;

use Illuminate\Database\Eloquent\Model;
use Modules\Common\Models\Seo;
use Illuminate\Database\Eloquent\Relations\MorphOne;

/**
 * @mixin Model
 * @property Seo $seo
 * @method seoIndexable
 */
trait HasSeo
{
    public function seo(): MorphOne
    {
        return $this->morphOne(Seo::class, 'model');
    }

    public function getSeoOrEmpty(): Seo
    {
        return $this->seo ?? new Seo();
    }

    public function scopeSeoIndexable($query)
    {
        return $query->whereHas('seo', function ($query) {
            $query->where('robots', 'not like', '%noindex%')
                ->where('robots', 'not like', '%noindex')
                ->where('robots', 'not like', 'noindex%');
        });
    }
}
