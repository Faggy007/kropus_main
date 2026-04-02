@props([
    'breadcrumbs' => null,
    'title' => null,
    'description' => null
])

<div class="pt-[1.25rem] lg:pt-[2.5rem]">

    @if($breadcrumbs)
        <div class="mb-[1.25rem] lg:mb-[2.5rem]">
            @include('partials.breadcrumbs', ['items' => $breadcrumbs])
        </div>
    @endif

    @if($title)
        <h1 class="title-2 mb-[1.25rem] lg:mb-[2.25rem]">{{$title}}</h1>
    @endif

    @if ($description)
        <p class="text-2 mb-[1.25rem] lg:mb-[2.875rem]">
            {!! $description !!}
        </p>
    @endif
</div>
