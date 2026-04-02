<?php

namespace Modules\Common\Services\Sitemap;

class ChainSitemapRepository implements SitemapRepository
{
    public function __construct(
        /** @var $repositories <array-key, SitemapRepository> */
        protected array $repositories
    )
    {
    }

    public function getItems(): array
    {
        $items = [];

        foreach ($this->repositories as $repository) {
            $items = array_merge($items, $repository->getItems());
        }

        return $items;
    }
}
