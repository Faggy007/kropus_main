<div class="grid grid-cols-1 lg:grid-cols-3">
    <a data-wow-delay="0.3s" href="{{ frontend_url('catalog') }}" class="wow animate__fadeInUp animate__animated pt-[1.25rem] px-[1.25rem] pb-[1.5rem] lg:p-[2.5rem] relative group hover:outline hover:border-transparent hover:outline-primary hover:z-[10] cursor-pointer border border-gray-light">
        <h3 class="title-3 text-dark-light group-hover:text-primary mb-6 lg:mb-0 lg:h-[10.625rem]">
            Типовые корпуса </h3>
        {!! icon('corpus-typically')->class('h-auto w-[85%] lg:w-full mx-auto mb-6 lg:mb-[5rem] text-secondary transition group-hover:scale-110 group-hover:text-primary') !!}
        <div class="font-alt lg:text-[1.625rem] lh-100 tracking-[-1px] group-hover:text-primary">
            <p class="mb-2 lg:mb-5">
                <span class="text-secondary group-hover:text-primary">Типовые корпуса — </span>
                проверенные решения для вашего оборудования.
            </p>
            <p>
                Быстрые сроки, оптимальная цена, надежная конструкция
            </p>
        </div>
    </a>
    <a data-wow-delay="0.6s" href="{{ frontend_url('custom') }}" class="wow animate__fadeInUp animate__animated pt-[1.25rem] px-[1.25rem] pb-[1.5rem] lg:p-[2.5rem] relative group group hover:outline hover:outline-primary hover:border-transparent hover:z-[10] cursor-pointer border border-gray-light lg:ml-[-1px]">
        <h3 class="title-3 text-dark-light group-hover:text-primary mb-6 lg:mb-0 lg:h-[10.625rem]">
            Корпуса по вашему техническому заданию
        </h3>
        {!! icon('corpus-tz')->class('h-auto w-[85%] lg:w-full mx-auto mb-6 lg:mb-[5rem] text-secondary transition group-hover:scale-110 group-hover:text-primary') !!}
        <div class="font-alt lg:text-[1.625rem] lh-100 tracking-[-1px] group-hover:text-primary">
            <p class="mb-2 lg:mb-5">
                <span class="text-secondary group-hover:text-primary">—  Нет типового решения? </span>
            </p>
            <p>
                — Разработаем корпус по вашему ТЗ от чертежа до готового изделия
            </p>
        </div>
    </a>
    <div data-wow-delay="0.9s" class="wow animate__fadeInUp animate__animated pt-[1.25rem] px-[1.25rem] pb-[1.5rem] lg:p-[2.5rem] flex flex-col border border-gray-light lg:ml-[-1px]">
        <h3 class="title-3 text-dark-light mb-5">
            Дополнительные услуги
        </h3>

        @foreach($services as $service)
            @php

            $name = $service->getTranslatedField('title');
            $icon = $service->getCustomFieldFilePath('service_icon');

            @endphp
            <a @class([
                            'inline-flex lg:text-[1.625rem] lh-100 tracking-[-1px] group hover:text-primary mb-2 lg:mb-3 hover:underline',
                            'items-center' => count(explode(' ', $name)) < 3,
                        ]) href="{{ frontend_url($service) }}">
                @if($icon)
                    {!! icon($icon)->class('text-secondary group-hover:text-primary w-[2rem] lg:w-[3.25rem] h-auto mr-3 lg:mr-[1.125rem] shrink-0') !!}
                @endif
                {{ $name }}
            </a>
        @endforeach

        <a href="{{ frontend_url('services') }}" class="btn btn-primary w-full mt-6 lg:mt-auto">
            <span>Весь список</span>
            {!! icon('arrow-right')->class('relative top-[0.1rem] text-white w-[2rem] h-auto ml-[0.625rem]') !!}
        </a>
    </div>
</div>

