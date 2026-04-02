@props(['post'])

<div>
    <h3 class="title-3 mb-[1.5rem] lg:mb-[3.25rem]">Другие проекты:</h3>
    <div class="mb-[3.125rem] lg:mb-[1.875rem]">
        @livewire('related-posts', [
            'categories' => ['projects'],
            'exceptIds' => [$post->id],
            'buttonTitle' => 'Все проекты',
            'buttonLink' => frontend_url('projects'),
            'titleLineClamp' => 3,
            'showDate' => false,
            'showCategory' => false,
        ])
    </div>
    @include('partials.calculator-banner-vertical')
</div>
