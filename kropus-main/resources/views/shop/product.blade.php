@props(['product', 'seo', 'data'])
@php
    use App\Facades\MobileDetect;
@endphp
@include('partials.seo', ['seo' => $seo])
<x-app-layout>
    <section class="container">
        @include('partials.page-hero', [
             'breadcrumbs' => [
                 ['name' => 'Каталог', 'url' => frontend_url('catalog')],
                 ['name' => $product->product->category->getTranslatedField('title'), 'url' => frontend_url($product->product->category)]
             ],
        ])
    </section>
    <main class="container">
        <div class="lg:flex gap-[2.5rem] max-w-full">
            <div class="w-55/100 flex-shrink-0">
                @if(!MobileDetect::isMobile())
                    @include('shop.parts.product-slider', ['data' => $data])
                    <div class="h-[1.25rem]"></div>
                @endif
            </div>
            <div>
                <h1 class="title-3 mb-[1.25rem] lg:mb-[1.5rem]">{{ $data->title }}</h1>

                <div class="grid grid-cols-1 gap-[1.25rem] lg:gap-[2.5rem]">
                    @if($data->description)
                        <div class="text-2 text-[#363636]">{{ $data->description }}</div>
                    @endif

                    @if(MobileDetect::isMobile())
                        @include('shop.parts.product-slider', ['data' => $data])
                    @endif

                    @foreach($data->modifierGroups as $modifierGroup)
                        <div>
                            <p class="text-2 text-[#363636] mb-4">{{ $modifierGroup->title }}</p>
                            <div class="flex gap-[0.875rem]">
                                @foreach($modifierGroup->modifiers as $modifier)
                                    <a href="{{ $modifier->url }}" @class([
                                        'p-[0.5rem] lg:p-[0.6875rem] rounded-[0.25rem] lg:rounded-[0.375rem] border min-w-[3.875rem] lg:min-w-[6.75rem] text-center subtitle-2 font-normal lg:font-semibold' => true,
                                        'text-white bg-primary border-primary' => $modifier->isActive,
                                        'border-[#BBBBBB] bg-[#F8F8F8] text-[#A4A4A4] hover:text-primary hover:border-primary cursor-pointer animation-button' => !$modifier->isActive,
                                    ])>
                                        {{ $modifier->title }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endforeach

                    @if($data->attributes)
                        <div class="grid grid-cols-1 gap-5">
                            @foreach($data->attributes as $attributes)
                                <div class="flex justify-between text-2 border-b border-[#C7C7C7] pb-4">
                                    <div class="text-[#999999]">{{ $attributes->title }}</div>
                                    <div class="text-[#363636]">{{ $attributes->value }}</div>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    <div class="flex flex-col lg:flex-row lg:justify-between lg:items-center gap-[1.25rem] lg:gap-[2.5rem]">
                        <div>
                            @if(false)
                                <div class="subtitle-3 whitespace-nowrap">
                                    от <span class="text-[2.5rem]">20 000</span> р.
                                </div>
                            @else
                                <div class="text-2 text-[#363636] whitespace-nowrap">
                                    Цена по запросу
                                </div>
                            @endif
                        </div>
                        @php
                            $message = 'Здравствуйте! Меня интересует продукт: ' . $data->title;
                        @endphp
                        <button
                            onclick="Livewire.dispatch('openModal', { component: 'contact-form-modal', arguments: {data: {message: @js($message)}} })"
                            class="btn btn-primary w-full cursor-pointer">
                            Оставить заявку
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </main>

    @if($data->infoTabs)
        <section class="overflow-hidden">
            <div class="container">
                <div class="pt-[3.125rem] lg:pt-[4.375rem]" x-data="{ tab: '{{$data->infoTabs[0]->slug}}' }">
                    <div class="flex overflow-x-scroll lg:overflow-x-visible gap-[2rem] lg:gap-[5rem] w-full lg:text-[1.625rem] text-[#363636] leading-[100%] border-b border-[#C7C7C7] mb-[2rem] lg:mb-[2.5rem]">
                        @foreach($data->infoTabs as $infoTab)
                            <div @click="tab = '{{$infoTab->slug}}'"
                                 class="relative cursor-pointer py-[1rem] lg:py-[1.5rem] whitespace-nowrap">
                                {{ $infoTab->title }}

                                <div :class="tab === '{{$infoTab->slug}}' ? 'block h-[3px] absolute bottom-0 lg:bottom-[-1px] left-0 w-full bg-primary' : 'hidden'">

                                </div>
                            </div>
                        @endforeach
                    </div>
                    @foreach($data->infoTabs as $infoTab)
                        <div :class="tab === '{{$infoTab->slug}}' ? 'block' : 'hidden'">
                            <div class="custom-content">
                                {!! $infoTab->content !!}
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <section class="overflow-hidden pt-[3.125rem] lg:pt-[4.375rem]">
        <div class="container">
            @livewire('related-products', [
                'title' => 'Другие товары',
                'exceptIds' => [$product->id],
            ])
        </div>
    </section>

    <div class="pb-[3.125rem] lg:pb-[4.375rem]">
        @livewire('sections.services-slider')
    </div>
</x-app-layout>
