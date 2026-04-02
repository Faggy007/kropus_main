@props(['animate' => false])
<section id="contact-form" class="py-[3.125rem] lg:py-[4.375rem]">
    <div class="container">
        <div @class([
                'bg-[#E2E6EC] p-[1.25rem] lg:p-[2.5rem] lg:rounded-[0.625rem] lg:flex justify-between relative overflow-hidden',
                'wow animate__fadeIn animate__animated' => $animate
            ]) data-wow-delay="0.3s">
            <img src="{{ asset('images/contact-form-inline-bg.svg') }}" class="w-[27.625rem] right-[-2.5rem] lg:right-auto lg:left-[4.75rem] bottom-0 absolute" alt="Contact Form Background">
            <div class="relative z-10">
                <h4 class="subtitle-3 mb-[1.25rem] lg:mb-[1.5rem]">Остались вопросы?</h4>
                <p class="lg:max-w-[25rem] text-[1.125rem] lg:text-[1.6875rem] mb-[1.25rem] lg:mb-0 text-[#7C7C7C] lh-120">
                    Оставьте ваши контактные
                    данные и мы с вами свяжемся
                    в ближайшее время
                </p>
            </div>
            <div class="lg:w-[44.5rem] shrink-0">
                @livewire('contact-form', ['type' => 'default_inline', 'view' => 'inline'])
            </div>
        </div>
    </div>
</section>
