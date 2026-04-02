@props(['post', 'seo'])
@include('partials.seo', ['seo' => $seo])
@php
    $sidebar = 'blog.sidebars.' . $post->category->slug;
    $sidebarExists = view()->exists($sidebar);
@endphp
<x-app-layout>
    <section class="pt-[1.25rem] lg:pt-[2.5rem]">
        <div class="container">

            <div class="mb-[1.25rem] lg:mb-[2.5rem]">
                @include('partials.breadcrumbs', ['items' => [
                    ['name' => $post->category->getTranslatedField('title'), 'url' => frontend_url($post->category)],
                ]])
            </div>

            @if($post->isFromCategory('news'))
                <div class="hidden lg:block">
                    <div class='flex items-center text-2 mb-[1.25rem]'>
                        {!! icon('calendar')->class('w-[2.25rem] h-[2.25rem] mr-[0.625rem] text-primary ') !!}
                        {{ $post->published_at->translatedFormat('d F Y') }}
                    </div>
                </div>
            @endif

            <div id="main" class="lg:flex gap-5">
                <div id="content" @class([
                    'lg:w-full' => !$sidebarExists,
                    'lg:w-2/3' => $sidebarExists,
                    'mb-[3.125rem] lg:mb-0',
                ])>
                    <h1 class="title-2">{{$post->getTranslatedField('title')}}</h1>

                    @if($post->isFromCategory('news'))
                        <div class="block lg:hidden">
                            <div class='flex items-center text-2 mt-2'>
                                {!! icon('calendar')->class('w-[1.25rem] h-[1.25rem] mr-[0.375rem] text-primary ') !!}
                                {{ $post->published_at->translatedFormat('d F Y') }}
                            </div>
                        </div>
                    @endif

                    <div class="h-[1.25rem] lg:h-[1.875rem]"></div>

                    @if($post->image && $post->getCustomField('show_image_on_page'))
                        <picture>
                            <img class="block object-cover aspect-16/10 mb-[1.25rem] lg:mb-[2.5rem]" src="{{ thumbnail()->url($post->image, 1200) }}" alt="{{$post->getTranslatedField('title')}}">
                        </picture>
                    @endif

                    <div class="custom-content">
                        @shortcodes
                            {!! $post->getTranslatedField('content') !!}
                        @endshortcodes
                    </div>
                </div>
                @if ($sidebarExists)
                    <aside id="sidebar" class="sidebar lg:w-1/3">
                        <div class="sidebar__inner">
                            @include($sidebar, ['post' => $post])
                        </div>
                    </aside>
                @endif
            </div>
        </div>
    </section>
    @if(
    !$sidebarExists &&
    $post->category->slug === 'news'
    )
        @livewire('sections.posts-slider', [
            'title' => 'Читайте также:',
            'categories' => ['news'],
            'exceptIds' => [$post->id],
        ])
    @endif
    @include('livewire.sections.contact-form')
    @if($sidebarExists)
        <script>
            onReady(function () {
                if (window.innerWidth > 1024) {
                    new StickySidebar('#sidebar', {
                        containerSelector: '#content',
                        innerWrapperSelector: '.sidebar__inner',
                        topSpacing: 20,
                        bottomSpacing: 20
                    });
                }
            });
        </script>
    @endif
</x-app-layout>
