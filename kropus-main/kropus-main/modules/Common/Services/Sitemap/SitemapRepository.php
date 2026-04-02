<?php

namespace Modules\Common\Services\Sitemap;

use Modules\Common\Data\SitemapUrl;

interface SitemapRepository
{
    /**
     * @return SitemapUrl[]
     */
    public function getItems(): array;
}
