@props(['category', 'posts', 'seo'])
@include('partials.seo', ['seo' => $seo])
@php
 $wrapperClass = 'grid grid-cols-1 lg:grid-cols-3 gap-5';
 if ($category->slug === 'projects') {
     $wrapperClass = 'grid grid-cols-1 gap-[1.25rem] lg:gap-[2.5rem]';
 }
@endphp
<x-app-layout>
    <section class="container">
        @include('partials.page-hero', [
            'breadcrumbs' => [
                ['name' => $category->getTranslatedField('title'), 'url' => frontend_url($category)]
            ],
            'title' => $category->getTranslatedField('title'),
            'description' => $category->getTranslatedField('description')
        ])

        <div @class([$wrapperClass])>
            @foreach($posts as $post)
                @if(view()->exists('blog.cards.' . $post->category?->slug))
                    @include('blog.cards.' . $post->category?->slug, ['post' => $post])
                @else
                    @include('blog.cards.default', ['post' => $post])
                @endif
            @endforeach
        </div>

        {{ $posts->links() }}
    </section>
    @include('livewire.sections.contact-form')
</x-app-layout>
