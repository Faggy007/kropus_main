<?php

namespace Modules\Blog\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use Modules\Common\Traits\HasCustomFields;
use Modules\Common\Traits\HasMultilingualFields;
use Modules\Common\Traits\HasPublicStatus;
use Modules\Common\Traits\HasSeo;
use Modules\Common\Traits\HasSlug;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

/**
 * @property int $id
 * @property Carbon $published_at
 * @property array $title
 * @property array $excerpt
 * @property array $content_schema
 * @property array $content
 * @property string $slug
 * @property string $image
 * @property int $category_id
 * @property null|int $order
 *
 * @property-read Category $category
 * @method static Builder|Post fromCategory(string|array $slug)
 */
class Post extends Model implements Sortable
{
    use HasPublicStatus, HasMultilingualFields, HasSeo, HasSlug, HasCustomFields, SoftDeletes, SortableTrait;

    protected $table = 'blog_posts';

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->published_at)) {
                $model->published_at = now();
            }
        });
        static::saving(function ($model) {
            $locales = config('app.locales');
            $content = $model->content ?? [];
            foreach ($locales as $locale) {
                $schema = $model->content_schema[$locale] ?? null;
                $content[$locale] = $schema ? tiptap_converter()->asHTML($schema) : '';
            }
            $model->content = $content;
        });
    }

    protected $fillable = [
        'published_at',
        'title',
        'excerpt',
        'slug',
        'content_schema',
        'content',
        'category_id',
        'image',
        'order',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'title' => 'array',
        'excerpt' => 'array',
        'content_schema' => 'array',
        'content' => 'array',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function isFromCategory(string|array $slug): bool
    {
        return in_array($this->category?->slug, (array) $slug);
    }

    public function slugFrom(): string
    {
        return $this->getTranslatedField('title');
    }

    public function scopeFromCategory($query, string|array $slug): Builder
    {
        return $query->whereHas('category', function ($q) use ($slug) {
            $q->whereIn('slug', (array) $slug);
        });
    }
}
