<?php

namespace Modules\Blog\Http\Controllers;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\View\View;
use Modules\Blog\Models\Category;
use Modules\Blog\Models\Post;
use Modules\Blog\Services\CategorySeoGenerator;
use Modules\Blog\Services\PostSeoGenerator;

class BlogController
{
    public function __construct(
        private CategorySeoGenerator $categorySeoGenerator,
        private PostSeoGenerator $postSeoGenerator,
    )
    {
    }

    public function resolve(?string $locale = null, ?string $slug1 = null, ?string $slug2 = null)
    {
        if (!in_array($locale, locales())) {
            $slug2 = $slug1;
            $slug1 = $locale;
        }

        if (
            $slug1 !== null &&
            $slug2 !== null
        ) {
            $post = Post::whereSlug($slug2)->whereHas('category', function (Builder $query) use ($slug1) {
                $query->where('slug', $slug1);
            })->firstOrFail();

            return $this->single($post);
        }

        if ($slug1) {
            $category = Category::whereSlug($slug1)->first();
            if ($category) {
                return $this->category($category);
            }

            $post = Post::whereSlug($slug1)->firstOrFail();
            if ($post) {
                return $this->page($post);
            }
        }

        return $this->page();
    }

    public function page(?Post $post = null): View
    {
        if ($post === null) {
            $post = Post::whereSlug('home')->firstOrFail();
        }

        if ($post->category !== null) {
            abort(404);
        }

        if (view()->exists('blog.pages.'.$post->slug)) {
            $view = 'blog.pages.'.$post->slug;
        } else {
            $view = 'blog.page';
        }

        $seo = $this->postSeoGenerator->generate($post);

        return view($view, [
            'seo' => $seo,
            'post' => $post,
        ]);
    }

    public function category(Category $category): View
    {
        $posts = Post::query()
            ->with(['category', 'customFields', 'publicStatus'])
            ->where('category_id', $category->id)
            ->orderBy('published_at', 'desc')
            ->paginate(12);

        $seo = $this->categorySeoGenerator->generate($category);

        return view('blog.category', [
            'seo' => $seo,
            'category' => $category,
            'posts' => $posts,
        ]);
    }

    public function single(Post $post): View
    {
        $seo = $this->postSeoGenerator->generate($post);

        return view('blog.single', [
            'seo' => $seo,
            'post' => $post,
        ]);
    }
}
