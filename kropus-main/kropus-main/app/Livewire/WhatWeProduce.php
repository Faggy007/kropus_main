<?php

namespace App\Livewire;

use Livewire\Component;
use Modules\Blog\Models\Post;

class WhatWeProduce extends Component
{
    public function render()
    {
        $services = Post::query()->fromCategory('services')
            ->ordered()
            ->limit(7)
            ->get();

        return view('livewire.what-we-produce', [
            'services' => $services,
        ]);
    }
}
