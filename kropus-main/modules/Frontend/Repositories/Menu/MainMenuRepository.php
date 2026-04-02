<?php

namespace Modules\Frontend\Repositories\Menu;
use Illuminate\Support\Collection;
use Modules\Common\Services\UrlService\UrlService;
use Modules\Frontend\Data\Menu\Menu;
use Modules\Frontend\Data\Menu\MenuItem;

class MainMenuRepository
{
    public function __construct(
        private UrlService $urlService,
    )
    {
    }

    public function get(): Menu
    {
        $menu = new Menu();

        $about = new MenuItem(
            __('frontend::menu.about'),
            $this->urlService->absolute('/about'),
        );

        $news = new MenuItem(
            __('frontend::menu.news'),
            $this->urlService->absolute('/news'),
        );

        $catalog = new MenuItem(
            __('frontend::menu.catalog'),
            $this->urlService->absolute('/catalog'),
        );

        $services = new MenuItem(
            __('frontend::menu.services'),
            $this->urlService->absolute('/services'),
        );

        $projects = new MenuItem(
            __('frontend::menu.projects'),
            $this->urlService->absolute('/projects'),
        );

        $contact = new MenuItem(
            __('frontend::menu.contact'),
            $this->urlService->absolute('/contact'),
        );

        return $menu->items(new Collection([
            $about,
            //$news,
            $catalog,
            $services,
            $projects,
            $contact,
        ]));
    }
}
