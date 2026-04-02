<?php

namespace App\Livewire\Layout;

use App\Settings\GeneralSettings;
use Livewire\Component;
use Modules\Frontend\Repositories\Menu\CompanyMenuRepository;
use Modules\Frontend\Repositories\Menu\MainMenuRepository;
use Modules\Frontend\Repositories\Menu\OtherMenuRepository;
use Modules\Frontend\Repositories\Menu\ServicesMenuRepository;

class Footer extends Component
{
    protected GeneralSettings $settings;

    protected ServicesMenuRepository $servicesMenuRepository;
    protected CompanyMenuRepository $companyMenuRepository;
    protected OtherMenuRepository $otherMenuRepository;

    public function boot(
        GeneralSettings    $settings,
        ServicesMenuRepository $servicesMenuRepository,
        CompanyMenuRepository $companyMenuRepository,
        OtherMenuRepository $otherMenuRepository,
    ): void
    {
        $this->settings = $settings;
        $this->servicesMenuRepository = $servicesMenuRepository;
        $this->companyMenuRepository = $companyMenuRepository;
        $this->otherMenuRepository = $otherMenuRepository;
    }

    public function render()
    {
        $servicesMenu = $this->servicesMenuRepository->get();
        $companyMenu = $this->companyMenuRepository->get();
        $otherMenu = $this->otherMenuRepository->get();

        return view('livewire.layout.footer', [
            'settings' => $this->settings,
            'firstColumnMenu' => $servicesMenu,
            'secondColumnMenu' => $companyMenu,
            'thirdColumnMenu' => $otherMenu
        ]);
    }
}
