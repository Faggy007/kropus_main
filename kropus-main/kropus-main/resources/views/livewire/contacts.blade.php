@props(['settings'])
@php
    use App\Facades\MobileDetect;
@endphp
<div class="lg:flex gap-5">
    <div class="lg:w-4/9">
        <p class="subtitle-2 mb-5">
            Адрес и режим работы:
        </p>
        <div class="flex lg:text-[1.375rem] lh-120 mb-4 lg:mb-8">
            {!! icon('location')->class('w-[1.625rem] shrink-0 text-primary mr-2') !!}
            {!! $settings->address !!}
        </div>
        <div class="flex items-center lg:text-[1.375rem] lh-120 mb-4 lg:mb-8">
            {!! icon('clock')->class('w-[1.625rem] shrink-0 text-primary mr-2') !!}
            <div>
                Пн-пт: 9:00 - 18:00 <span class="text-[#C7C7C7] mx-2 lg:mx-5">|</span> Cб-вс: выходной
            </div>
        </div>
        @if(MobileDetect::isMobile() && $settings->map_iframe)
            <div class="mb-5 lg:hidden rounded-[0.625rem] overflow-hidden">
                {!! $settings->map_iframe !!}
            </div>
        @endif
        <p class="subtitle-2 mb-4 lg:mb-5">
            Телефон и Email:
        </p>
        <p class="lg:text-[1.375rem] lh-120 text-[#7C7C7C] mb-4 lg:mb-5">
            По всем вопросам, Вы можете позвонить по номеру телефона или задать вопрос по почте
        </p>
        <div class="flex flex-col lg:flex-row gap-4 lg:gap-0 lg:items-center mb-5 lg:mb-8">
            <a href="tel:{{ str_replace(' ', '', $settings->phone) }}" class="flex items-center lg:text-[1.375rem] lh-120 hover:text-primary">
                {!! icon('phone')->class('w-[1.625rem] text-primary mr-2') !!}
                {{ $settings->phone }}
            </a>
            <div class="hidden lg:block text-[#C7C7C7] mx-5 text-[1.375rem] lh-120">|</div>
            <a href="mailto:{{ $settings->email }}" class="flex items-center lg:text-[1.375rem] lh-120 hover:text-primary">
                {!! icon('mail')->class('w-[1.625rem] text-primary mr-2') !!}
                {{ $settings->email }}
            </a>
        </div>
        @if($settings->tg_link || $settings->vk_link)
            <p class="subtitle-2 mb-4 lg:mb-5">
                Наши соцсети:
            </p>
            <div class="flex items-center gap-4">
                @if($settings->tg_link)
                    <a href="{{ $settings->tg_link }}" target="_blank" rel="noopener noreferrer" class="transition hover:scale-110">
                        {!! icon('social/tg')->class('h-[2.875rem] w-[2.875rem]') !!}
                    </a>
                @endif
                @if($settings->vk_link)
                    <a href="{{ $settings->vk_link }}" target="_blank" rel="noopener noreferrer" class="transition hover:scale-110">
                        {!! icon('social/vk')->class('h-[2.875rem] w-[2.875rem]') !!}
                    </a>
                @endif
            </div>
        @endif
    </div>
    @if(!MobileDetect::isMobile())
        <div class="hidden lg:block lg:w-5/9">
            <div class="rounded-[0.625rem] overflow-hidden">
                {!! $settings->map_iframe !!}
            </div>
        </div>
    @endif
    <!--<iframe class="w-full h-[20rem] lg:h-[30rem]" src="https://yandex.com/map-widget/v1/?ll=38.797707%2C55.082792&z=12.3" frameborder="1" allowfullscreen="true" style="position:relative;"></iframe>-->
</div>
