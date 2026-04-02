<?php

namespace Modules\Shop\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Common\Traits\HasMultilingualFields;
use Modules\Common\Traits\HasSlug;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

/**
 * @property int $id
 * @property string $slug
 * @property array|null $title
 * @property array|null $content_schema
 * @property array|null $content
 * @property int|null $order
 */
class InfoTab extends Model implements Sortable
{
    use HasMultilingualFields, HasSlug, SortableTrait;

    protected $table = 'shop_info_tabs';

    protected $casts = [
        'title' => 'array',
        'content' => 'array',
        'content_schema' => 'array',
    ];

    protected $fillable = [
        'slug',
        'title',
        'content_schema',
        'content',
        'order',
    ];

    protected static function boot()
    {
        parent::boot();
        static::saving(function ($model) {
            $locales = locales();
            $content = $model->content ?? [];
            foreach ($locales as $locale) {
                $schema = $model->content_schema[$locale] ?? null;
                $content[$locale] = $schema ? tiptap_converter()->asHTML($schema) : '';
            }
            $model->content = $content;
        });
    }
}
