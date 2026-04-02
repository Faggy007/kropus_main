<?php

namespace App\Livewire;

use Livewire\Attributes\Locked;
use Livewire\Component;
use Modules\Blog\Models\Post;

class RelatedPosts extends Component
{
    public string|array $categories = ['news'];

    public array $exceptIds = [];

    public string $sortBy = 'published_at';
    public string $sort = 'desc';

    #[Locked]
    public int $count = 5;

    public int $titleLineClamp = 2;

    public bool $showDate = true;

    public bool $showCategory = true;

    public ?string $buttonTitle = null;

    public ?string $buttonLink = null;

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

        return view('livewire.related-posts', compact('posts'));
    }
}
