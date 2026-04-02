<?php

namespace Modules\Blog\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Common\Traits\HasMultilingualFields;
use Modules\Common\Traits\HasSeo;
use Modules\Common\Traits\HasSlug;

/**
 * @property string $id
 * @property array $title
 * @property array $description
 * @property string $slug
 */
class Category extends Model
{
    use HasMultilingualFields, HasSlug, HasSeo;

    protected $table = 'blog_categories';

    protected $casts = [
        'title' => 'array',
        'description' => 'array',
    ];

    protected $fillable = [
        'title',
        'description',
        'slug'
    ];

    public function slugFrom(): string
    {
        return $this->getTranslatedField('title');
    }
}
