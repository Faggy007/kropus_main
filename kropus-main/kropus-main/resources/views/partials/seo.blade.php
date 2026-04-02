@props(['seo'])

@if ($seo->title)
    @section('title', $seo->title)
@endif

@if ($seo->description)
    @section('description', $seo->description)
@endif

@if ($seo->image)
    @section('image', $seo->image)
@endif

@if ($seo->canonical)
    @section('canonical', $seo->canonical)
@endif
