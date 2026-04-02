<section id="posts" class="pt-[3.125rem] lg:pt-[4.375rem] overflow-hidden">
    <div class="container">
        <div class="flex items-center justify-between mb-[1.5rem] lg:mb-[2.5rem]">
            @if ($titleLink)
                <a href="{{ $titleLink }}" @class([
                    'flex items-center hover:text-primary',
                    'wow animate__fadeInUp animate__animated' => $animate
                ]) data-wow-delay="0.3s">
                    <h3 class="title-2">{{ $title }}</h3>
                </a>
            @else
                <h3 @class([
                    'title-2',
                    'wow animate__fadeInUp animate__animated' => $animate
                ]) data-wow-delay="0.3s">{{ $title }}</h3>
            @endif
            <div class="flex gap-3 lg:gap-4">
                <button class="js-postsSlider-prev btn btn-primary w-[2rem] h-[2rem] lg:w-[3.75rem] lg:h-[3.75rem] p-0">
                    {!! icon('arrow-left')->class('text-white w-[1.5rem] lg:w-[3rem]') !!}
                </button>
                <button class="js-postsSlider-next btn btn-primary w-[2rem] h-[2rem] lg:w-[3.75rem] lg:h-[3.75rem] p-0">
                    {!! icon('arrow-right')->class('text-white w-[1.5rem] lg:w-[3rem]') !!}
                </button>
            </div>
        </div>
        <div class="swiper overflow-visible md:overflow-hidden js-postsSlider">
            <div class="swiper-wrapper">
                @php
                    $delay = 0;
                @endphp
                @foreach($posts as $post)
                    @php
                        $delay += 0.3;
                    @endphp
                    <div class="swiper-slide w-[80%]">
                        <div @class(['wow animate__zoomIn animate__animated' => $animate]) data-wow-delay="{{$delay}}s">
                            @include('blog.cards.default', ['post' => $post])
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    @assets
    <script>
        onReady(function () {
            new Swiper('.js-postsSlider', {
                slidesPerView: 'auto',
                loop: false,
                navigation: {
                    nextEl: '.js-postsSlider-next',
                    prevEl: '.js-postsSlider-prev',
                },
                spaceBetween: 20,
                freeMode: true,
                breakpoints: {
                    640: {
                        slidesPerView: 2,
                        freeMode: false,
                    },
                    1024: {
                        slidesPerView: 3,
                    },
                },
            });
        })
    </script>
    @endassets
</section>
