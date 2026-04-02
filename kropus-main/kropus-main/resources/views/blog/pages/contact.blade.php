@props(['post'])
@include('partials.seo', ['seo' => $seo])
<x-app-layout>
    <section class="container pb-[3.125rem] lg:pb-[4.375rem]">

        @include('partials.page-hero', [
             'breadcrumbs' => [['name' => $post->getTranslatedField('title'), 'url' => frontend_url($post)]],
             'title' => $post->getTranslatedField('title'),
        ])

        @livewire('contacts')

    </section>
</x-app-layout>
