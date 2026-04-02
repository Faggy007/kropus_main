<?php

namespace Modules\Blog\Services\Sitemap;

use Illuminate\Support\Collection;
use Modules\Blog\Models\Category;
use Modules\Common\Data\SitemapUrl;
use Modules\Common\Services\Sitemap\SitemapRepository;
use Modules\Common\Services\UrlService\UrlService;

class CategorySitemapRepository implements SitemapRepository
{
    public function __construct(
        private UrlService $urlService
    )
    {
    }

    public function getItems(): array
    {
        $items = [];
        $query = Category::query();
        $query->chunk(100, function (Collection $categories) use (&$items) {
            foreach ($categories as $category) {
                foreach (locales() as $locale) {
                    locale($locale);
                    $items[] = new SitemapUrl(
                        $this->urlService->entity($category),
                        $category->getTranslatedField('title', $locale),
                        'weekly',
                        0.8,
                        $locale
                    );
                }
            }
        });
        return $items;
    }
}
