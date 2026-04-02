<?php

namespace Modules\Common\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Common\Enums\PublicStatus as PublicStatusEnum;

class PublicStatus extends Model
{
    protected $fillable = [
        'status',
    ];

    protected $casts = [
        'status' => PublicStatusEnum::class,
    ];
}
