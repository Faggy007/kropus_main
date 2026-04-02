@props(['post'])

<a href="{{ frontend_url($post) }}" class="group block p-[1rem] lg:p-[2.5rem] bg-[#F8F8F8] hover:bg-[#F1F1F1] active:bg-[#EBEBEB] transition overflow-hidden">
    <div class="lg:flex gap-[2.5rem]">
        <div class="hidden lg:block w-[25rem] shrink-0">
            @if($post->image)
                <img class="object-cover w-full h-full aspect-[400/268]" src="{{ thumbnail()->url($post->image, 500) }}" alt="{{ $post->getTranslatedField('title') }}">
            @endif
        </div>
        <div class="flex flex-col">
            <h4 class="text-[1.125rem] lg:text-[1.812rem] font-alt font-bold leading-[120%] tracking-[-0.58px] mb-4 lg:mb-[2.5rem]" >
                {{ $post->getTranslatedField('title') }}
            </h4>

            @if($post->image)
                <img class="block lg:hidden object-cover w-full h-full aspect-[400/268] mb-4" src="{{ thumbnail()->url($post->image, 500) }}" alt="{{ $post->getTranslatedField('title') }}">
            @endif

            <p class="text-[#363636] lg:text-[1.5rem] font-alt font-semibold leading-[120%] mb-[1rem]">Задача:</p>
            <p class="text-2 text-[#363636] line-clamp-3">
                {{ $post->getTranslatedCustomField('task_description') }}
            </p>

            <div class="lg:text-right text-[#999999] group-hover:text-primary lg:text-[1.25rem] leading-[120%] mt-auto pt-4 lg:pt-[1.75rem]">
                <div class="inline-flex items-center">
                    <span>Подробнее</span>
                    {!! icon('arrow-right')->class('w-[1.5rem] h-[1.5rem] lg:w-[2rem] lg:h-[2rem]') !!}
                </div>
            </div>
        </div>
    </div>
</a>
