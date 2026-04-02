@props([
    'product',
    'showDescription' => true,
    'showAttributes' => true,
])
<a href="{{ $product->url }}" class="block bg-[#F8F8F8] pt-[1.5rem] px-[1.25rem] pb-[1.25rem] lg:p-[1.875rem] relative hover:bg-[#F1F1F1] active:bg-[#EBEBEB] transition">
    {!! icon('arrow-out')->class('w-[1.25rem] h-[1.25rem] text-primary absolute right-[1.875rem] top-[1.875rem]') !!}

    <h4 class="subtitle-2 line-clamp-2 mb-4 lg:mb-5 pr-12">
        {{ $product->title }}
    </h4>

    @if($showDescription)
        <p class="text-[1.125rem] lg:text-[1.25rem] lh-120 mb-4 lg:mb-[2rem] line-clamp-5">
            {{ $product->description }}
        </p>
    @endif

    @if($product->image)
        <img class="aspect-16/10 object-contain mb-3 lg:mb-[1.5rem]" src="{{ thumbnail()->url($product->image, 350) }}" alt="{{ $product->title }}">
    @endif

    @if($showAttributes)
        <div class="text-[1.125rem] lg:text-[1.25rem] lh-120">
            <p class="pb-4 lg:pb-[1.25rem] mb-4 lg:mb-[1.25rem] border-b border-[#C7C7C7]">
                Характеристики
            </p>
            <ul class="grid grid-cols-1 gap-3 lg:gap-4">
                @foreach($product->attributes as $attribute)
                    @if ($loop->index > 3)
                        @break
                    @endif
                    <li class="flex justify-between">
                        <span class="text-[#999999]">{{ $attribute->title }}</span>
                        <span>{{ $attribute->value }}</span>
                    </li>
                @endforeach
            </ul>
        </div>
    @endif
</a>
