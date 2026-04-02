@props(['images', 'columns' => 3, 'aspect_ratio' => '4/3'])
@php
// Dont remove this line, it is required for the correct work of the gallery
$classes = 'grid-cols-1 sm:grid-cols-2 md:grid-cols-1 md:grid-cols-2 md:grid-cols-3 md:grid-cols-4 aspect-16/9 aspect-4/3 aspect-1/1';
$aspectClass = 'aspect-' . $aspect_ratio;
$unique = uniqid();
@endphp
<div class="custom-content-block grid grid-cols-1 sm:grid-cols-2 md:grid-cols-<?=$columns?> gap-5">
    @foreach(array_reverse($images) as $key => $image)
        <a class="block" data-fancybox="{{$unique}}" href="{{ thumbnail()->url($image, 1980) }}" data-fancybox-group="{{$unique}}">
            <img loading="lazy" class="{{$aspectClass}} object-cover" src="{{ thumbnail()->url($image, 500) }}" alt="Галерея {{$key + 1}}">
        </a>
    @endforeach
</div>
