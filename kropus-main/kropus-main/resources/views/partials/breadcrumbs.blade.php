@props(['items'])

@php
    $items = [
        ['name' => __('frontend::breadcrumbs.home'), 'url' => frontend_url()->home()],
       ...$items
    ];
    $currentClass = 'text-black';
@endphp

<div class="flex flex-wrap lg:text-[1.625rem] lh-100 tracking-[-0.52px] text-[#BBBBBB]">
    @foreach($items as $item)
        @if($item['url'])
            <a href="{{ $item['url'] }}" @class([
                $currentClass => $loop->last,
                'hover:text-primary'
            ])>
                {{ $item['name'] }}
            </a>
        @else
            <span @class([
                $currentClass => $loop->last,
            ])>
                {{ $item['name'] }}
            </span>
        @endif
        @if (!$loop->last)
            <span class="mx-2">/</span>
        @endif
    @endforeach
</div>
