<?php

namespace Modules\Common\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property array $fields
 */
class CustomFields extends Model
{
    protected $table = 'custom_fields';

    protected $fillable = [
        'fields'
    ];

    protected $casts = [
        'fields' => 'array',
    ];
}
