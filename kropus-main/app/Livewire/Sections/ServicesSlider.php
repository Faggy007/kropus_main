<?php

namespace App\Livewire\Sections;

use Livewire\Component;
use Modules\Blog\Models\Post;

class ServicesSlider extends Component
{
    public string $title = 'Дополнительные услуги';

    public function render()
    {
        $services = Post::query()->fromCategory('services')
            ->with(['customFields', 'category'])
            ->ordered()
            ->get();

        return view('livewire.sections.services-slider', [
            'services' => $services,
        ]);
    }
}
