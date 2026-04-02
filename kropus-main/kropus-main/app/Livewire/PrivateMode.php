<?php

namespace App\Livewire;

use Livewire\Component;

class PrivateMode extends Component
{
    public function boot()
    {

    }

    public function exit()
    {
        session()->remove('private_mode');
    }

    public function render()
    {
        return view('livewire.private-mode');
    }
}
