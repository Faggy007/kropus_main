@props(['products'])
@php
    use App\Facades\MobileDetect;
@endphp
<div class="grid grid-cols-1 gap-[3.125rem] lg:gap-[4.375rem]">
    @foreach($products as $product)
        @livewire('related-products', [
            'title' => $product->getTranslatedField('title'),
            'type' => MobileDetect::isMobile() ? 'grid' : 'slider',
            'products' => [$product->slug],
        ])
    @endforeach
</div>
