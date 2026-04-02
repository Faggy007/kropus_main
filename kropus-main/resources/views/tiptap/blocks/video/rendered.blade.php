@props(['video', 'poster'])
@php
    $posterAttribute = '';
    if ($poster ?? null) {
        $posterAttribute = 'poster="' . thumbnail()->url($poster, 1200) . '"';
    }
@endphp
<video class="block mb-5" src="{{public_url($video)}}" {!! $posterAttribute !!} controls>
    <p>Ваш браузер не поддерживает HTML5 видео.</p>
</video>
