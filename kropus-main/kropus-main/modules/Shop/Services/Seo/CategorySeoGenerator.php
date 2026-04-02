<?php

namespace Modules\Shop\Services\Seo;

use Modules\Shop\Models\Category;
use Modules\Common\Data\Seo;
use Modules\Common\Services\UrlService\UrlService;

class CategorySeoGenerator
{
    public function __construct(
        private UrlService $urlService,
    )
    {
    }

    public function generate(Category $category): Seo
    {
        $title = $category->getSeoOrEmpty()->getTranslatedField('title') ?? $category->getTranslatedField('title');
        $description = $category->getSeoOrEmpty()->getTranslatedField('description') ?? $category->getTranslatedField('description');
        $robots = $category->getSeoOrEmpty()->getTranslatedField('robots');
        $url = $this->urlService->entity($category);

        return Seo::from([
            'title' => $title,
            'description' => $description,
            'robots' => $robots,
            'canonical' => $url,
        ]);
    }
}
