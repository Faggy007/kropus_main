@props(['widgetId' => uniqid(), 'variants', 'type'])
<div id="{{$widgetId}}">
    <div class="flex items-center justify-between mb-[1.5rem] lg:mb-[2.5rem]">
        <h3 @class([
            'title-3',
            'wow animate__fadeInUp animate__animated' => $animate,
        ]) data-wow-delay="0.3s">{{ $title }}</h3>
        @if($type === 'slider')
            <div class="flex gap-3 lg:gap-4">
                <button class="js-projectsSlider-{{$widgetId}}-prev btn btn-primary w-[2rem] h-[2rem] lg:w-[3.75rem] lg:h-[3.75rem] p-0">
                    {!! icon('arrow-left')->class('text-white w-[1.5rem] lg:w-[3rem]') !!}
                </button>
                <button class="js-projectsSlider-{{$widgetId}}-next btn btn-primary w-[2rem] h-[2rem] lg:w-[3.75rem] lg:h-[3.75rem] p-0">
                    {!! icon('arrow-right')->class('text-white w-[1.5rem] lg:w-[3rem]') !!}
                </button>
            </div>
        @endif
    </div>
    <div @class(['swiper overflow-visible md:overflow-hidden js-projectsSlider-' . $widgetId => $type === 'slider'])>
        <div @class([
            'swiper-wrapper' => $type === 'slider',
            'grid grid-cols-1 lg:grid-cols-3 gap-5' => $type === 'grid'
        ]) >
            @php
            $delay = 0;
            @endphp
            @foreach($variants as $variant)
                @php
                $delay += 0.3;
                @endphp
                <div @class(['swiper-slide w-[80%]' => $type === 'slider'])>
                    <div @class(['wow animate__zoomIn animate__animated' => $animate]) data-wow-delay="{{$delay}}s">
                        @include('shop.cards.default', ['product' => $variant])
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    @script
    <script>
        onReady(function () {
            new Swiper('.js-projectsSlider-{{$widgetId}}', {
                slidesPerView: 'auto',
                loop: false,
                spaceBetween: 20,
                navigation: {
                    nextEl: '.js-projectsSlider-{{$widgetId}}-next',
                    prevEl: '.js-projectsSlider-{{$widgetId}}-prev',
                },
                freeMode: true,
                breakpoints: {
                    640: {
                        slidesPerView: 2,
                        freeMode: false,
                    },
                    1024: {
                        slidesPerView: 3,
                        freeMode: false,
                    },
                },
            });
        })
    </script>
    @endscript
</div>
