<?php

namespace Modules\Common\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Common\Traits\HasMultilingualFields;

/**
 * @property string $id
 * @property array $title
 * @property array $description
 * @property string $image
 * @property array $og_title
 * @property array $og_description
 * @property string $og_image
 * @property array $robots
 */
class Seo extends Model
{
    use HasMultilingualFields;

    protected $fillable = [
        'title',
        'description',
        'image',
        'og_title',
        'og_description',
        'og_image',
        'robots',
    ];

    protected $casts = [
        'title' => 'array',
        'description' => 'array',
        'og_title' => 'array',
        'og_description' => 'array',
        'robots' => 'array'
    ];
}
