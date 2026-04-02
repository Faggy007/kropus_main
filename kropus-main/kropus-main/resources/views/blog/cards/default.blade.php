@props([
    'post',
    'titleLineClamp' => 2,
    'showDescription' => true,
])

<a href="{{ frontend_url($post) }}" class="block bg-[#F8F8F8] hover:bg-[#F1F1F1] active:bg-[#EBEBEB] transition overflow-hidden">
    <div class="aspect-[271/169] lg:aspect-[427/210] bg-[#EBEBEB]">
        @if($post->image)
            <img class="object-cover w-full h-full" src="{{ thumbnail()->url($post->image, 500) }}" alt="{{ $post->category->getTranslatedField('title') }}">
        @endif
    </div>
    <div class="p-[1.25rem] lg:p-[1.875rem] min-h-[13.25rem] lg:min-h-[17.75rem]">
        <div class="text-2 mb-[1rem] lg:mb-[0.875rem] flex items-center">
            <span class="text-primary">{{ $post->category->getTranslatedField('title') }}</span>
            <div class="bg-gray-light w-[1px] h-[0.75rem] mx-[0.75rem]"></div>
            <span class="text-[#999999] lowercase">{{ $post->published_at->translatedFormat('d F Y') }}</span>
        </div>

        <h4 @class(['subtitle-2 mb-[1rem] lg:mb-[0.875rem]', 'line-clamp-' . $titleLineClamp => $titleLineClamp > 0])>
            {{ $post->getTranslatedField('title') }}
        </h4>

        @if($showDescription)
            <p class="text-2 text-[#9E9E9E] line-clamp-4">
                {!! $post->getTranslatedField('excerpt') !!}
            </p>
        @endif
    </div>
</a>
