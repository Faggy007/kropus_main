@props(['post'])
@include('partials.seo', ['seo' => $seo])
<x-app-layout>
    <section class="overflow-hidden">
        <div class="container">
            @include('partials.page-hero', [
                'breadcrumbs' => [['name' => $post->getTranslatedField('title'), 'url' => frontend_url($post)]],
                'title' => $post->getTranslatedField('title'),
                'description' => $post->getTranslatedField('excerpt')
           ])

            @livewire('related-products-catalog')

            <div class="pt-[3.125rem] lg:pt-[4.375rem]">
                @include('partials.calculator-banner-horizontal')
            </div>
        </div>
    </section>

    @livewire('sections.services-slider')

    <div class="h-[3.125rem] lg:h-[4.375rem]"></div>
</x-app-layout>
