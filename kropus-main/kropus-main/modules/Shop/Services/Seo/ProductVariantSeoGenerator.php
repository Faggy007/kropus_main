<?php

namespace Modules\Shop\Services\Seo;

use Modules\Common\Data\Seo;
use Modules\Common\Services\UrlService\UrlService;
use Modules\Shop\Models\ProductVariant;
use Modules\Shop\Services\ProductContentProcessor\Processor;

class ProductVariantSeoGenerator
{
    public function __construct(
        private UrlService $urlService,
        private Processor $processor,
    )
    {
    }

    public function generate(ProductVariant $variant): Seo
    {
        $title = $variant->product->getSeoOrEmpty()->getTranslatedField('title') ?? $variant->getTranslatedField('title');
        $description = $variant->product->getSeoOrEmpty()->getTranslatedField('description') ?? $variant->getTranslatedField('description');
        $robots = $variant->product->getSeoOrEmpty()->getTranslatedField('robots');
        $url = $this->urlService->entity($variant);

        return Seo::from([
            'title' => $this->processor->process($variant, $title ?? ''),
            'description' => $this->processor->process($variant, $description ?? ''),
            'robots' => $robots,
            'canonical' => $url,
        ]);
    }
}
