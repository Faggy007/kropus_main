@props(['post', 'seo'])
@include('partials.seo', ['seo' => $seo])
<x-app-layout>
    <section class="container">
        @include('partials.page-hero', [
          'breadcrumbs' => [
              ['name' => $post->getTranslatedField('title'), 'url' => frontend_url($post)]
          ],
          'title' => $post->getTranslatedField('title'),
        ])
    </section>
    <section class="container">
        <div class="lg:flex justify-between gap-[2rem] mb-[3.125rem] lg:mb-[2.5rem]">
            <p class="wow animate__fadeInUp animate__animated font-alt font-medium text-[1.25rem] lg:text-[2.25rem] mb-[1.25rem] lg:mb-0 leading-[100%] tracking-[-0.72px]" data-wow-delay="0.3s">
                <span class="text-[#3F6075]">PROKORPUS</span> — современное производство корпусов и комплектующих из
                пластика
                и металла в Московской области.
            </p>
            <img src="{{ asset('images/tmp/about.png') }}" alt="О PROKORPUS"
                 data-wow-delay="0.9s"
                 class="wow animate__fadeIn animate__animated lg:hidden object-cover aspect-1320/580 mb-[1.25rem]"/>
            <p class="wow animate__fadeInUp animate__animated max-w-[26.75rem] font-alt lg:text-[1.75rem] leading-[100%] tracking-[-0.84]" data-wow-delay="0.6s">
                Мы реализуем полный цикл:
                от создания 3D-модели
                до серийного выпуска продукции.
            </p>
        </div>
        <img src="{{ asset('images/tmp/about.png') }}" alt="О PROKORPUS"
             data-wow-delay="0.9s"
             class="wow animate__fadeIn animate__animated hidden lg:block object-cover aspect-1320/580 mb-[4.375rem]"/>
    </section>
    <section class="container mb-[3.125rem] lg:mb-[4.375rem]">
        <h2 class="wow animate__fadeInUp animate__animated title-2 mb-[1.25rem] lg:mb-[2.5rem]" data-wow-delay="0.3s">
            Наши преимущества
        </h2>
        @php
            $advantages = [
                [
                    'title' => 'Полный цикл производства',
                    'icon' => 'about/full-circle',
                    'items' => [
                        '3D-моделирование и проектирование',
                        'Прототипирование и опытные образцы',
                        'Серийное производство (литьё, ЧПУ-обработка)',
                        'Постобработка и финишная отделка'
                    ]
                ],
                 [
                    'title' => 'Гибкий подход',
                    'icon' => 'about/flexible',
                    'items' => [
                        'Типовые решения для стандартных задач',
                        'Индивидуальные проекты любой сложности',
                        'Работаем с любыми объемами: от единичных экземпляров до крупных серий',
                    ]
                ],
                 [
                    'title' => 'Материалы и технологии',
                    'icon' => 'about/computer',
                    'items' => [
                        'Литье пластмасс под давлением',
                        'Литье в силиконовые формы',
                        'Фрезерная и токарная обработка',
                        'Широкий выбор материалов: от конструкционных пластиков до алюминиевых сплавов'
                    ]
                ],
                 [
                    'title' => 'Технологическое оснащение',
                    'icon' => 'about/robot',
                    'items' => [
                        'Современное оборудование: 3D-принтеры, ТПА, ЧПУ станки',
                        'Собственное конструкторское бюро',
                        'Многоуровневый контроль качества',
                    ]
                ],
            ];
        @endphp
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-[1.25rem] relative">
            @php
                $delay = 0;
            @endphp
            @foreach($advantages as $item)
                <div class="wow animate__zoomIn animate__animated p-[1rem] lg:p-[1.875rem] bg-[#F8F8F8]" data-wow-delay="{{ $delay }}s">
                    <div class="flex justify-between items-center pb-5 mb-5 border-b border-[rgba(153, 153, 153,0.7)]">
                        <h3 class="subtitle-2">
                            {{ $item['title'] }}
                        </h3>
                        {!! icon($item['icon'])->class('h-[2.25rem] lg:h-[3.75rem] w-[2.25rem] lg:w-[3.75rem] text-primary') !!}
                    </div>
                    <ul class="list-disc text-2 grid grid-cols-1 gap-4 lg:gap-5 marker:text-primary ml-6">
                        @foreach($item['items'] as $advantage)
                            <li class="pl-2">{{ $advantage }}</li>
                        @endforeach
                    </ul>
                </div>
                @php
                    if ($delay === 0.3) {
                        $delay = 0;
                        continue;
                    }
                    $delay += 0.3;
                @endphp
            @endforeach
        </div>
    </section>
    <section class="container mb-[3.125rem] lg:mb-[4.375rem]">
        <h2 class="wow animate__fadeInUp animate__animated title-2 mb-[1.25rem] lg:mb-[2.5rem]" data-wow-delay="0.3s">
            С нами работают
        </h2>
        <div class="lg:grid grid-cols-2 gap-[1.25rem]">
            <div class="grid grid-cols-1 gap-[1.25rem] lg:gap-[0.875rem]">
                @php
                $items = [
                    [
                        'icon' => 'about/electricity',
                        'title' => 'Производители электроники и РЭА'
                    ],
                    [
                        'icon' => 'about/rocket',
                        'title' => 'Стартапы и изобретатели'
                    ],
                    [
                        'icon' => 'about/chemistry',
                        'title' => 'Научно-исследовательские центры'
                    ],
                    [
                        'icon' => 'about/factory',
                        'title' => 'Промышленные предприятия'
                    ],
                ];
                @endphp
                @foreach($items as $item)
                    <div class="wow animate__fadeInUp animate__animated bg-[#F8F8F8] px-[1rem] py-[1.125rem] lg:p-[1.25rem] flex items-center">
                        {!! icon($item['icon'])->class('w-[2rem] lg:w-[3.75rem] h-[2rem] lg:h-[3.75rem] text-primary mr-3 lg:mr-6 shrink-0') !!}
                        <h4 class="subtitle-2">{{ $item['title'] }}</h4>
                    </div>
                @endforeach
            </div>
            <div class="hidden lg:block">
                @php
                    $delay += 0.3;
                @endphp
                <img src="{{ asset('images/tmp/about-2.png') }}" alt="С нами работают"
                        data-wow-delay="{{$delay}}s"
                     class="wow animate__fadeIn animate__animated block object-cover aspect-4/3 h-full"/>
            </div>
        </div>
    </section>
    <section class="container">
        <div class="wow animate__fadeInUp animate__animated bg-[#E2E6EC] rounded-[0.625rem] relative px-[1rem] lg:px-[1.875rem] py-[1.75rem] lg:py-[3.5rem] overflow-hidden" data-wow-delay="0.3s">
            <img src="{{ asset('images/bloquote-bg.svg') }}" class="h-full w-auto right-[-4rem] lg:right-0 top-0 absolute" alt="Contact Form Background">
            <p class="relative z-10 text-[#292929] text-center lg:text-left font-alt text-[1.125rem] lg:text-[1.8125rem] italic leading-[120%] tracking-[-0.58px] max-w-[75rem]">
                <span class="font-semibold">Наша цель</span> — обеспечить вас качественной продукцией в согласованные сроки, чтобы вы могли сосредоточиться на развитии своего бизнеса.
            </p>
        </div>
    </section>
    <section class="pb-[3.125rem] lg:pb-[4.375rem]"></section>
    <script>
        onReady(function() {
            initWow();
        });
    </script>
</x-app-layout>
