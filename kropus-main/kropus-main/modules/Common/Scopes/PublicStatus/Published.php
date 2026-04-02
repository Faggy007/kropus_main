<?php

namespace Modules\Common\Scopes\PublicStatus;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Modules\Common\Enums\PublicStatus as PublicStatusEnum;

class Published implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        $builder->whereHas('publicStatus', fn(Builder $q) => $q->where('status', PublicStatusEnum::PUBLISHED));
    }
}
