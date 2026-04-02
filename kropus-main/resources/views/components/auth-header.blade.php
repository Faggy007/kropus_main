@props([
    'title',
    'description',
])

<div class="flex w-full flex-col text-center">
    <h1 class="title-3 mb-4">{{ $title }}</h1>
    <p class="text-2 text-[#7C7C7C]">{{ $description }}</p>
</div>
