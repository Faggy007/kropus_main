@props(['category', 'seo', 'products'])
@include('partials.seo', ['seo' => $seo])
<x-app-layout>
    <section class="container">

        @include('partials.page-hero', [
             'breadcrumbs' => [
                 ['name' => 'Каталог', 'url' => frontend_url('catalog')],
                 ['name' => $category->getTranslatedField('title'), 'url' => frontend_url($category)]
             ],
             'title' => $category->getTranslatedField('title'),
             'description' => $category->getTranslatedField('description'),
        ])

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-5">
            @foreach($products as $product)
                @include('shop.cards.default', ['product' => $product, 'showDescription' => false])
            @endforeach
        </div>

        {{ $products->links() }}

        <div class="pt-[3.125rem] lg:pt-[4.375rem]">
            @include('partials.calculator-banner-horizontal')
        </div>

        <div class="pb-[3.125rem] lg:pb-[4.375rem]">
            @livewire('sections.services-slider')
        </div>
    </section>
</x-app-layout>
