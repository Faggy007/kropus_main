<x-app-layout>
    <section class="bg-[#F5F6F8]">
        <div class="container py-[3.125rem] lg:py-[5rem] text-center">
            @hasSection('errorCode')
                <p class="text-[#E8E9EE] text-[9.625rem] lg:text-[24.75rem] leading-[100%] font-extrabold tracking-[4.6px] lg:tracking-[11.879px] font-alt">@yield('errorCode')</p>
            @endif
            <div class="relative top-[-2.5rem] lg:top-[-8.5rem]">
                @hasSection('errorTitle')
                    <h1 class="title-2 font-semibold mb-5 lg:mb-8">@yield('errorTitle')</h1>
                @endif
                @hasSection('errorMessage')
                    <p class="text-[#7C7C7C] lg:text-[1.6875rem] lh-120 mb-5 lg:mb-8">@yield('errorMessage')</p>
                @endif
                <a class="btn btn-primary w-full md:w-auto lg:min-w-[17.375rem]" href="{{ frontend_url()->home() }}">
                    На главную
                </a>
            </div>
        </div>
    </section>
</x-app-layout>
