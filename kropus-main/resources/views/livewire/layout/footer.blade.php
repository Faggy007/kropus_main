@props(['settings', 'firstColumnMenu', 'secondColumnMenu', 'thirdColumnMenu'])
<footer class="bg-secondary">
    <div class="py-[1.75rem] lg:py-[2.5rem] border-b border-[#7A8E9B] text-[#E5E5E5] text-2">
        <div class="container lg:hidden">
            <a class="mb-[2rem] inline-block" href="{{ frontend_url('/') }}">
                <img src="{{ asset('images/logo-white.svg') }}" alt="Logo" class="h-[2.25rem]">
            </a>
        </div>
        <div class="container flex flex-col lg:flex-row">
            <div class="shrink-0 lg:w-30/100 order-4 lg:order-1">
                <a class="hidden lg:inline-block mb-[2rem] lg:mb-[2.5rem]" href="{{ frontend_url('/') }}">
                    <img src="{{ asset('images/logo-white.svg') }}" alt="Logo" class="h-[2.25rem] lg:h-[2.5rem]">
                </a>

                @if($settings->phone)
                    <a class="flex items-center hover:text-primary mb-4 lg:mb-5" href="tel:{{ str_replace(' ', '', $settings->phone) }}">
                        {!! icon('phone')->class('w-[1.25rem] text-primary mr-2') !!}
                        {{ $settings->phone }}
                    </a>
                @endif
                @if($settings->email)
                    <a class="flex items-center hover:text-primary mb-4 lg:mb-5" href="mailto:{{$settings->email}}">
                        {!! icon('mail')->class('w-[1.25rem] text-primary mr-2') !!}
                        {{ $settings->email }}
                    </a>
                @endif

                @if($settings->legal_full_name || $settings->inn || $settings->ogrn)
                    <div class="mb-5">
                        @if($settings->legal_full_name)
                            <p class="text-3">{{ $settings->legal_full_name }}</p>
                        @endif
                        @if($settings->inn)
                            <p class="text-3">ИНН {{ $settings->inn }}</p>
                        @endif
                        @if($settings->ogrn)
                            <p class="text-3">ОГРН {{ $settings->ogrn }}</p>
                        @endif
                    </div>
                @endif

                <p class="text-3">
                    {!! $settings->address !!}
                </p>

                <a class="text-3 block pt-5 hover:text-primary group" rel="nofollow" href="https://kropus.com" target="_blank">
                    Входит в группу компаний: <br>
                    <!--Научно-производственный центр «Кропус»-->
                    {!! icon('kropus')->class('h-[1.25rem] w-auto mt-3 text-white group-hover:text-primary') !!}
                </a>
            </div>
            <div class="grid grid-cols-2 lg:flex w-full gap-8 order-2 mb-8 lg:mb-0">
                <div class="hidden lg:block lg:w-40/100">
                    <p class="text-white font-semibold mb-5 font-alt">Услуги</p>
                    <ul class="flex flex-col gap-4 text-3">
                        @foreach ($firstColumnMenu->items as $item)
                            <li>
                                <a href="{{ $item->url }}" class="hover:text-primary">
                                    {{ $item->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="lg:w-30/100">
                    <p class="text-white font-semibold mb-5 font-alt">О компании</p>
                    <ul class="flex flex-col gap-4 text-3">
                        @foreach ($secondColumnMenu->items as $item)
                            <li>
                                <a href="{{ $item->url }}" class="hover:text-primary">
                                    {{ $item->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="lg:w-30/100">
                    <p class="text-white font-semibold mb-5 font-alt">Другое</p>
                    <ul class="flex flex-col gap-4 text-3">
                        @foreach ($thirdColumnMenu->items as $item)
                            <li>
                                <a href="{{ $item->url }}" class="hover:text-primary">
                                    {{ $item->name }}
                                </a>
                            </li>
                        @endforeach
                        <li>
                            <a role="button" href="javascript:void(0);" class="hover:text-primary showHideToggleCookiePreferencesModal">
                                Настройки cookies
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="py-5 text-center text-3 text-[#D2D2D2]">
        Прокорпус {{ date('Y') }}
    </div>
</footer>
