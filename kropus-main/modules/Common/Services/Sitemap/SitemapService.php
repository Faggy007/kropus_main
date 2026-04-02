<?php

namespace Modules\Common\Services\Sitemap;

use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

class SitemapService
{
    public function __construct(
        private SitemapRepository $repository
    )
    {
    }

    public function generate(): void
    {
        $sitemap = Sitemap::create();

        foreach ($this->repository->getItems() as $item) {
            $url = Url::create($item->url);
            if ($item->frequency) {
                $url->setChangeFrequency($item->frequency);
            }
            if ($item->priority) {
                $url->setPriority($item->priority);
            }
            $sitemap->add($url);
        }

        $sitemap->writeToFile(public_path('sitemap.xml'));
    }
}
