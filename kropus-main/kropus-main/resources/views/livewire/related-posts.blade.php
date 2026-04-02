<div class="py-[1.25rem] lg:py-[2.5rem] px-[1.5rem] lg:px-[1.875rem] bg-[#F8F8F8]">
    @foreach($posts as $post)
        <a class="group" href="{{ frontend_url($post) }}">
            @if($showDate || $showCategory)
                <div class="flex lg:justify-between items-center text-2 mb-4 lg:mb-[1.25rem]">
                    @if($showCategory)
                        <span class="text-primary">
                            {{ $post->category->getTranslatedField('title') }}
                        </span>
                    @endif
                    @if($showCategory && $showDate)
                        <div class="bg-gray-light w-[1px] h-[0.75rem] mx-2 lg:hidden"></div>
                    @endif
                    @if($showDate)
                        <span class="text-[#999999] lowercase">{{ $post->published_at->translatedFormat('d F Y') }}</span>
                    @endif
                </div>
            @endif
            <h4 class="subtitle-2 transition group-hover:text-primary line-clamp-{{ $titleLineClamp }}">{{ $post->getTranslatedField('title') }}</h4>
        </a>
        @if (!$loop->last)
            <div class="h-[1px] bg-[#C7C7C7] my-4 lg:mt-[1.875rem] lg:mb-[1.25rem]"></div>
        @endif
    @endforeach
    @if($buttonTitle && $buttonLink)
        <a href="{{ $buttonLink }}" class="btn btn-primary w-full mt-[2.5rem]">
            {{ $buttonTitle }}
        </a>
    @endif
</div>
