<?php

namespace App\Livewire\Sections;

use Livewire\Component;
use Modules\Blog\Models\Post;

class ServicesSidebar extends Component
{
    public array $exceptIds = [];

    public int $limit = 6;

    public function render()
    {
        $services = Post::query()->fromCategory('services')
            ->with(['customFields', 'category'])
            ->when(fn() => !empty($this->exceptIds), fn($query) => $query->whereNotIn('id', $this->exceptIds))
            ->ordered()
            ->limit($this->limit)
            ->get();

        return view('livewire.sections.services-sidebar', [
            'services' => $services,
        ]);
    }
}
