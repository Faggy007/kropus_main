<?php

namespace Modules\Blog\Services;

use Modules\Blog\Models\Post;
use Modules\Common\Data\Seo;
use Modules\Common\Services\ThumbnailService\ThumbnailService;
use Modules\Common\Services\UrlService\UrlService;

class PostSeoGenerator
{
    public function __construct(
        private UrlService $urlService,
        private ThumbnailService $thumbnailService,
    )
    {
    }

    public function generate(Post $post): Seo
    {
        $title = $post->getSeoOrEmpty()->getTranslatedField('title') ?? $post->getTranslatedField('title');
        $description = $post->getSeoOrEmpty()->getTranslatedField('description') ?? $post->getTranslatedField('excerpt');
        $robots = $post->getSeoOrEmpty()->getTranslatedField('robots');
        $image = $post->getSeoOrEmpty()->image ?? $post->image;
        $url = $this->urlService->entity($post);

        return Seo::from([
            'title' => $title,
            'description' => $description,
            'robots' => $robots,
            'image' => $image ? $this->thumbnailService->url($image, 600, 400) : null,
            'canonical' => $url,
        ]);
    }
}
