<section id="services" class="pt-[3.125rem] lg:pt-[4.375rem] overflow-hidden">
    <div class="container">
        <div class="flex items-center justify-between mb-[1.5rem] lg:mb-[2.5rem]">
            <h3 class="title-3">{{ $title }}</h3>
            <div class="flex gap-3 lg:gap-4">
                <button class="js-servicesSlider-prev btn btn-primary w-[2rem] h-[2rem] lg:w-[3.75rem] lg:h-[3.75rem] p-0">
                    {!! icon('arrow-left')->class('text-white w-[1.5rem] lg:w-[3rem]') !!}
                </button>
                <button class="js-servicesSlider-next btn btn-primary w-[2rem] h-[2rem] lg:w-[3.75rem] lg:h-[3.75rem] p-0">
                    {!! icon('arrow-right')->class('text-white w-[1.5rem] lg:w-[3rem]') !!}
                </button>
            </div>
        </div>
        <div class="swiper overflow-visible lg:overflow-hidden js-servicesSlider">
            <div class="swiper-wrapper">
                @foreach($services as $post)
                    @include('blog.cards.services-small', ['post' => $post, 'additionalClasses' => 'swiper-slide !h-auto w-[13rem]'])
                @endforeach
            </div>
        </div>
    </div>
    @assets
    <script>
        onReady(function () {
            new Swiper('.js-servicesSlider', {
                slidesPerView: 'auto',
                spaceBetween: 20,
                navigation: {
                    nextEl: '.js-servicesSlider-next',
                    prevEl: '.js-servicesSlider-prev',
                },
                freeMode: true,
                breakpoints: {
                    1024: {
                        slidesPerView: 5,
                        freeMode: false,
                    },
                }
            });
        })
    </script>
    @endassets
</section>
