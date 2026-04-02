<?php

namespace Modules\Frontend\Repositories\Menu;

use Modules\Blog\Models\Post;
use Modules\Common\Services\UrlService\UrlService;
use Modules\Frontend\Data\Menu\Menu;
use Modules\Frontend\Data\Menu\MenuItem;

class ServicesMenuRepository
{
    public function __construct(
        private UrlService $urlService,
    )
    {
    }

    public function get(): Menu
    {
        $menu = new Menu();

        $services = Post::query()
            ->fromCategory('services')
            ->limit(6)
            ->get();

        $items = $services->map(function (Post $service) {
            return new MenuItem(
                $service->getTranslatedField('title'),
                $this->urlService->entity($service),
            );
        });

        return $menu->items($items);
    }
}
