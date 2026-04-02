<?php

namespace Modules\Blog\Services\Sitemap;

use Illuminate\Support\Collection;
use Modules\Blog\Models\Post;
use Modules\Common\Data\SitemapUrl;
use Modules\Common\Services\Sitemap\SitemapRepository;
use Modules\Common\Services\UrlService\UrlService;

class PostSitemapRepository implements SitemapRepository
{
    public function __construct(
        private UrlService $urlService
    )
    {
    }

    public function getItems(): array
    {
        $items = [];
        $query = Post::query()->with(['category', 'publicStatus'])->seoIndexable()->published();
        $query->chunk(100, function (Collection $posts) use (&$items) {
            foreach ($posts as $post) {
                foreach (locales() as $locale) {
                    locale($locale);
                    $items[] = new SitemapUrl(
                        $this->urlService->entity($post),
                        $post->getTranslatedField('title', $locale),
                        $post->category ? 'monthly' : 'daily',
                        $post->category ? 0.7 : 1,
                        $locale
                    );
                }
            }
        });
        return $items;
    }
}
