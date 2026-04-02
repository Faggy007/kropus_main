<div class="bg-[#E2E6EC] p-[1.25rem] lg:p-[2.5rem] lg:rounded-[0.625rem] relative overflow-hidden">
    {!! icon('arrow-out')->class('w-[1rem] lg:w-[2rem] h-[1rem] lg:h-[2rem] text-primary absolute top-[1.5rem] lg:top-[2.5rem] right-[1.5rem] lg:right-[2.5rem]') !!}
    <img class="absolute bottom-0 right-0 w-[17rem] lg:w-[32rem]" src="{{ asset('images/calculator-banner-bg.svg') }}" alt="Banner background">
    <div class="relative z-10">
        <h4 class="subtitle-3 mb-[1.25rem] lg:mb-[1.75rem]">Вам нужен корпус по индивидуальным размерам?</h4>
        <p class="max-w-[56.25rem] text-[1.125rem] lg:text-[1.6875rem] mb-[1.25rem] lg:mb-[2rem] text-[#7C7C7C] lh-120">
            Заполните форму и мы сделаем вам коммерческое предложение исходя из ваших потребностей!
        </p>
    </div>
    <a class="w-full lg:w-auto lg:min-w-[23.25rem] btn btn-white relative z-10" href="{{ frontend_url('custom') }}">
        Рассчитать стоимость
    </a>
</div>
