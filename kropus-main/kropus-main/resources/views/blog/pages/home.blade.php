@props(['post', 'seo'])
@include('partials.seo', ['seo' => $seo])
<x-app-layout>
    <section id="hero" class="lg:min-h-[calc(100vh-5.25rem)] relative flex flex-col justify-end">
        <img src="{{ asset('images/tmp/hero-2.jpg') }}" alt="Hero"
             class="absolute object-cover object-bottom w-full h-full left-0 top-0"/>
        <div class="hero-gradient absolute object-cover w-full h-full left-0 top-0"></div>

        <div class="container relative py-[3.75rem] lg:py-[8.625rem]">
            <h1 class="wow animate__fadeInUp animate__animated title-1 text-white mb-[1.625rem] lg:mb-[2.25rem] max-w-[63.875rem]">
                Корпусируем под задачу — быстро, точно, надёжно
            </h1>
            <p data-wow-delay="0.3s" class="wow animate__fadeInUp animate__animated subtitle-1 text-white mb-[1.625rem] lg:mb-[2.25rem] max-w-[56rem]">
                Типовые и уникальные корпуса на заказ, с предустановленными
                электромонтажными компонентами и/или монтажными
                отверстиями под них
            </p>
            <div data-wow-delay="0.6s" class="wow animate__fadeInUp animate__animated flex flex-col lg:flex-row gap-5">
                <a href="{{ frontend_url('custom') }}" class="btn btn-primary w-full lg:w-auto lg:min-w-[17.375rem]">Получить расчет</a>
                <a href="{{ frontend_url('catalog') }}" class="btn btn-white w-full lg:w-auto lg:min-w-[17.375rem]">Типовая продукция</a>
            </div>
        </div>
    </section>
    <section id="services" class="pt-[3.125rem] lg:pt-[6.25rem] pb-[3.125rem] lg:pb-[6.25rem] ">
        <div class="container">
            <h2 class="wow animate__fadeInUp animate__animated title-2 mb-[1.25rem] lg:mb-[2.5rem]">Что мы производим</h2>
            @livewire('what-we-produce')
        </div>
    </section>
    <section id="catalog" class="overflow-hidden">
        <div class="container">
            @livewire('related-products', [
                'animate' => true,
                'title' => 'Каталог товаров'
            ])
        </div>
    </section>
    @livewire('sections.posts-slider', [
        'animate' => true,
        'title' => 'Новости',
        'titleLink' => frontend_url('news')
    ])
    @include('livewire.sections.contact-form', [
        'animate' => true,
    ])
    <script>
        onReady(function() {
            initWow();
        });
    </script>
</x-app-layout>
