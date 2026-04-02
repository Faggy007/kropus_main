<div class="grid gap-4" style="grid-template-columns: repeat(<?=$columns?>, 1fr);">
    @foreach(array_reverse($images) as $image)
        <div>
            <img style="aspect-ratio: <?=$aspect_ratio ?? '1/1'?>; object-fit: cover;" src="{{ thumbnail()->url($image, 300) }}" alt="Загрузка...">
        </div>
    @endforeach
</div>
