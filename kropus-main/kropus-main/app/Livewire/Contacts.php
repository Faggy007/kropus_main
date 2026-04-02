<?php

namespace App\Livewire;

use App\Settings\GeneralSettings;
use Livewire\Component;
class Contacts extends Component
{
    protected GeneralSettings $settings;

    public function boot(
        GeneralSettings $settings
    ): void {
        $this->settings = $settings;
    }

    public function render()
    {
        return view('livewire.contacts', [
            'settings' => $this->settings,
        ]);
    }
}
