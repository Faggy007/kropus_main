@props(['data'])

<div>
    <div class="swiper group relative js-productsSlider mb-[1rem] lg:mb-[1.25rem]">
        <div class="swiper-wrapper">
            @foreach($data->galleryItems as $galleryItem)
                @php
                    $href = match ($galleryItem->type) {
                       'image' => thumbnail()->url($galleryItem->image),
                       'video' => public_url($galleryItem->video),
                       'iframe' => $galleryItem->iframe,
                       default => ''
                   };
                @endphp
                <a data-fancybox="gallery" href="{{ $href }}" class="swiper-slide">
                    <img class="aspect-16/10 object-cover"
                         src="{{ thumbnail()->url($galleryItem->previewImage, 800) }}"
                         alt="{{ $data->title }}">
                    @if(in_array($galleryItem->type, ['video', 'iframe']))
                        <div class="absolute transition group-hover:scale-110 left-[50%] top-[50%] transform translate-x-[-50%] translate-y-[-50%] bg-[rgba(0,0,0,0.5)] rounded-full w-[6rem] h-[6rem] flex items-center justify-center">
                            <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M26.6667 20L15.8334 26.6603V13.3397L26.6667 20Z" fill="white"/>
                            </svg>
                        </div>
                    @endif
                </a>
            @endforeach
        </div>
        <div
            class="js-productsSlider-prev absolute left-[0.5rem] lg:left-[1.875rem] top-[50%] transform translate-y-[-50%] z-50 transition lg:opacity-0 group-hover:opacity-100">
            <button class="btn btn-dark-ghost w-[2rem] h-[2rem] lg:w-[3.75rem] lg:h-[3.75rem] p-0 cursor-pointer">
                {!! icon('arrow-left')->class('text-white w-[1.5rem] lg:w-[3rem]') !!}
            </button>
        </div>

        <div
            class="js-productsSlider-next absolute right-[0.5rem] lg:right-[1.875rem] top-[50%] transform translate-y-[-50%] z-50 transition lg:opacity-0 group-hover:opacity-100">
            <button class="btn btn-dark-ghost w-[2rem] h-[2rem] lg:w-[3.75rem] lg:h-[3.75rem] p-0 cursor-pointer">
                {!! icon('arrow-right')->class('text-white w-[1.5rem] lg:w-[3rem]') !!}
            </button>
        </div>
    </div>
    <div class="swiper js-productsThumbsSlider">
        <div class="swiper-wrapper">
            @foreach($data->galleryItems as $galleryItem)
                @php
                    $href = match ($galleryItem->type) {
                        'image' => thumbnail()->url($galleryItem->image),
                        'video' => public_url($galleryItem->video),
                        'iframe' => $galleryItem->iframe,
                        default => ''
                    }
                @endphp
                <div class="swiper-slide border">
                    <img class="aspect-16/10 cursor-pointer object-cover"
                         src="{{ thumbnail()->url($galleryItem->previewImage, 300) }}"
                         alt="{{ $data->title }}">
                </div>
            @endforeach
        </div>
    </div>
</div>

<script>
    onReady(function () {
        const productThumbsSlider = new Swiper(".js-productsThumbsSlider", {
            spaceBetween: 16,
            slidesPerView: 3,
            freeMode: true,
            watchSlidesProgress: true,
            threshold: 5,
        });

        new Swiper(".js-productsSlider", {
            spaceBetween: 10,
            loop: true,
            navigation: {
                nextEl: ".js-productsSlider-next",
                prevEl: ".js-productsSlider-prev",
            },
            thumbs: {
                swiper: productThumbsSlider,
                slideThumbActiveClass: 'border-primary',
            },
        });
    });
</script>
