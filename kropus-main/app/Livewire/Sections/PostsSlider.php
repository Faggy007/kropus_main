<?php

namespace App\Livewire\Sections;

use Livewire\Attributes\Locked;
use Livewire\Component;
use Modules\Blog\Models\Post;

class PostsSlider extends Component
{
    public string|array $categories = ['news'];

    public array $exceptIds = [];

    public string $sortBy = 'published_at';
    public string $sort = 'desc';

    #[Locked]
    public int $count = 10;

    public bool $animate = false;

    public string $title = 'Новости';

    public ?string $titleLink = null;

    public function render()
    {
        $posts = Post::query()
            ->whereHas('category', function ($query) {
                $query->whereIn('slug', (array)$this->categories);
            })
            ->when(fn() => !empty($this->exceptIds), fn($query) => $query->whereNotIn('id', $this->exceptIds))
            ->orderBy($this->sortBy, $this->sort)
            ->limit($this->count)
            ->get();

        return view('livewire.sections.posts-slider', compact('posts'));
    }
}
