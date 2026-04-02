<div class="bg-[#E2E6EC] p-[1.5rem] lg:p-[1.875rem] relative">
    {!! icon('arrow-out')->class('w-[1rem] lg:w-[2rem] h-[1rem] lg:h-[2rem] text-primary absolute top-[1.25rem] lg:top-[2.375rem] right-[1.25rem] lg:right-[2.375rem]') !!}
    <img class="absolute bottom-0 right-0 w-[17rem]" src="{{ asset('images/calculator-banner-bg.svg') }}" alt="Banner background">
    <h4 class="subtitle-2 mb-[1.25rem] relative z-10">
        Вам нужен корпус
        по индивидуальным
        размерам?
    </h4>
    <p class="text-2 text-[#7C7C7C] mb-[1.25rem] lg:mb-[1.875rem] relative z-10">
        Заполните форму и мы сделаем вам коммерческое предложение исходя из ваших потребностей!
    </p>
    <a class="btn btn-white w-full relative z-10" href="{{ frontend_url('custom') }}">
        Рассчитать стоимость
    </a>
</div>
