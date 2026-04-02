@props(['post', 'seo'])
@include('partials.seo', ['seo' => $seo])
<x-app-layout>
    <section class="container">
        @include('partials.page-hero', [
            'breadcrumbs' => [
                ['name' => $post->getTranslatedField('title'), 'url' => frontend_url($post)]
            ],
            'title' => $post->getTranslatedField('title'),
        ])

        <div class="custom-content">
            @shortcodes
            {!! $post->getTranslatedField('content') !!}
            @endshortcodes
        </div>
    </section>
    @include('livewire.sections.contact-form')
</x-app-layout>
