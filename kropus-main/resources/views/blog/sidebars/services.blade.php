@props(['post'])

<div>
    <h3 class="title-3 mb-[1.5rem] lg:mb-[3.25rem]">Другие услуги:</h3>
    <div class="mb-[3.125rem] lg:mb-[1.875rem]">
        @if(true)
            @livewire('sections.services-sidebar', [
                'exceptIds' => [$post->id],
            ])
        @else
            @livewire('related-posts', [
                'categories' => ['services'],
                'exceptIds' => [$post->id],
                'buttonTitle' => 'Все услуги',
                'buttonLink' => frontend_url('services'),
                'titleLineClamp' => 3,
                'showDate' => false,
                'showCategory' => false,
            ])
        @endif
    </div>
    @include('partials.calculator-banner-vertical')
</div>
