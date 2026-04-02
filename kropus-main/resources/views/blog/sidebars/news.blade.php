@props(['post'])

<div>
    <h3 class="title-3 mb-[1.5rem] lg:mb-[3.25rem]">Читайте также:</h3>
    <div class="mb-[3.125rem] lg:mb-[1.875rem]">
        @livewire('related-posts', [
            'categories' => ['news'],
            'exceptIds' => [$post->id],
            'buttonTitle' => 'Все новости',
            'buttonLink' => frontend_url('news')
        ])
    </div>
    @include('partials.calculator-banner-vertical')
</div>
