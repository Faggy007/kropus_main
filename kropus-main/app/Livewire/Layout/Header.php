<?php

namespace App\Livewire\Layout;

use App\Settings\GeneralSettings;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Modules\Frontend\Repositories\Menu\MainMenuRepository;
use Modules\Frontend\Repositories\Menu\MobileMenuRepository;

class Header extends Component
{
    protected MainMenuRepository $mainMenuRepository;

    protected MobileMenuRepository $mobileMenuRepository;

    protected GeneralSettings $settings;

    public function boot(
        MainMenuRepository $mainMenuRepository,
        MobileMenuRepository $mobileMenuRepository,
        GeneralSettings $settings
    ): void {
        $this->mainMenuRepository = $mainMenuRepository;
        $this->mobileMenuRepository = $mobileMenuRepository;
        $this->settings = $settings;
    }

    public function render(): View
    {
        $menu = $this->mainMenuRepository->get();
        $mobileMenu = $this->mobileMenuRepository->get();
        return view('livewire.layout.header', [
            'menu' => $menu,
            'mobileMenu' => $mobileMenu,
            'settings' => $this->settings,
        ]);
    }
}
