@props(['post', 'additionalClasses' => ''])
@php
    $name = $post->getTranslatedCustomField('short_title', $post->getTranslatedField('title'));
    $icon = $post->getCustomFieldFilePath('service_icon');
@endphp
<div class="relative {{ $additionalClasses }}">
    <a href="{{ frontend_url($post) }}" class="h-full flex flex-col bg-[#F8F8F8] hover:bg-[#F1F1F1] active:bg-[#EBEBEB] transition  rounded-[0.625rem] p-[1rem] lg:p-[1.25rem]">
        <div class="relative mb-[1.5rem] flex items-start justify-between">
            @if($icon)
                {!! icon($icon)->class('text-secondary w-[3.125rem] h-[3.125rem]') !!}
            @endif
            {!! icon('arrow-out')->class('w-[1.125rem] h-[1.125rem] text-primary') !!}
        </div>
        <h4 class="font-alt text-[1.25rem] lg:text-[1.5rem] line-clamp-5 font-semibold leading-[100%] mt-auto">
            {{ $name }}
        </h4>
    </a>
</div>
