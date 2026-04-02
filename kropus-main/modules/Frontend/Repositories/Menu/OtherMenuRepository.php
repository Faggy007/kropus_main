<?php

namespace Modules\Frontend\Repositories\Menu;

use Illuminate\Support\Collection;
use Modules\Common\Services\UrlService\UrlService;
use Modules\Frontend\Data\Menu\Menu;
use Modules\Frontend\Data\Menu\MenuItem;

class OtherMenuRepository
{
    public function __construct(
        private UrlService $urlService,
    )
    {
    }

    public function get(): Menu
    {
        $menu = new Menu();

        $privacy = new MenuItem(
            __('frontend::menu.privacy'),
            $this->urlService->absolute('/privacy'),
        );

        $cookies = new MenuItem(
            __('frontend::menu.cookies'),
            $this->urlService->absolute('/cookies'),
        );

        return $menu->items(new Collection([
            $privacy,
            $cookies
        ]));
    }
}
