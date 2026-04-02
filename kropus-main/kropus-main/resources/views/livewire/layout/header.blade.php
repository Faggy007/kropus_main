@props(['menu', 'mobileMenu', 'settings'])

<header x-data="{ mobileMenuIsOpen: false }" x-on:click.away="mobileMenuIsOpen = false">
    <div
        class="relative z-[100] border-b border-[#C7C7C7] bg-white">
        <div class="container">
            <div class="flex items-center justify-between h-[4.25rem] lg:h-[5.25rem]">
                <a href="{{ frontend_url('/') }}">
                    <img src="{{ asset('images/logo.svg') }}" alt="Logo" class="h-[2.25rem] lg:h-[2.5rem]">
                </a>
                <div class="hidden lg:flex gap-8 text-[1.4375rem] lh-120">
                    @foreach ($menu->items as $item)
                        <a href="{{ $item->url }}" class="hover:text-primary">
                            {{ $item->name }}
                        </a>
                    @endforeach
                </div>
                <div class="hidden lg:flex items-center gap-6 text-[1.375rem]">
                    @if($settings->phone)
                        <a class="flex items-center hover:text-primary"
                           href="tel:{{ str_replace(' ', '', $settings->phone) }}">
                            {!! icon('phone')->class('w-[1.625rem] text-primary mr-2') !!}
                            {{ $settings->phone }}
                        </a>
                    @endif
                    @if($settings->email)
                        <a class="flex items-center hover:text-primary" href="mailto:{{$settings->email}}">
                            {!! icon('mail')->class('w-[1.625rem] text-primary mr-2') !!}
                            {{ $settings->email }}
                        </a>
                    @endif
                </div>
                <div class="lg:hidden">
                    <button x-on:click="mobileMenuIsOpen = !mobileMenuIsOpen" x-bind:aria-expanded="mobileMenuIsOpen"
                            type="button" aria-label="mobile menu" aria-controls="mobileMenu">
                        {!! icon('menu')->class('w-[1.75rem] h-[1.75rem] text-black cursor-pointer') !!}
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Мобильное меню -->
    <div
        x-cloak
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="-translate-y-full"
        x-transition:enter-end="translate-y-0"
        x-transition:leave="transition ease-in duration-300"
        x-transition:leave-start="translate-y-0"
        x-transition:leave-end="-translate-y-full"
        role="dialog"
        aria-modal="true"
        aria-labelledby="mobileMenuLabel"
        id="mobileMenu"
        class="fixed bg-white h-screen w-full overflow-y-scroll top-0 left-0 z-[100]"
        x-show="mobileMenuIsOpen"
    >
        <div class="mb-[0.625rem]">
            <div class="container">
                <div class="flex items-center justify-between h-[4.25rem] ">
                    <a href="{{ frontend_url('/') }}">
                        <img src="{{ asset('images/logo.svg') }}" alt="Logo" class="h-[2.25rem]">
                    </a>
                    <div>
                        <button x-on:click="mobileMenuIsOpen = !mobileMenuIsOpen"
                                x-bind:aria-expanded="mobileMenuIsOpen" type="button" aria-label="mobile menu close"
                                aria-controls="mobileMenu">
                            {!! icon('close')->class('w-[1.75rem] h-[1.75rem] text-black cursor-pointer') !!}
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <nav class="font-alt font-medium leading-[1.875rem] text-[1rem] mb-[2.5rem]">
                <ul class="flex flex-col gap-[0.25rem]">
                    @foreach ($mobileMenu->items as $item)
                        <li>
                            <a href="{{ $item->url }}" class="bg-[#F7F7F7] hover:bg-[#F0F0F0] py-[0.5625rem] pl-[1rem] pr-[0.5rem] flex align-center justify-between transition hover:text-primary">
                                <span>{{ $item->name }}</span>
                                {!! icon('chevron-right')->class('w-[1.5rem] h-[1.5rem] text-black') !!}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </nav>

            <div class="flex items-center text-[0.875rem] leading-[120%] mb-[1.25rem]">
                @if($settings->phone)
                    <a class="flex items-center hover:text-primary"
                       href="tel:{{ str_replace(' ', '', $settings->phone) }}">
                        {!! icon('phone')->class('w-[1.25rem] text-primary mr-2') !!}
                        {{ $settings->phone }}
                    </a>
                @endif
                <div class="w-[1px] bg-[#C7C7C7] mx-3 h-[1rem]"></div>
                @if($settings->email)
                    <a class="flex items-center hover:text-primary" href="mailto:{{$settings->email}}">
                        {!! icon('mail')->class('w-[1.25rem] text-primary mr-2') !!}
                        {{ $settings->email }}
                    </a>
                @endif
            </div>

            <div class="flex items-center gap-[0.625rem]">
                @if($settings->tg_link)
                    <a href="{{ $settings->tg_link }}" target="_blank" rel="noopener noreferrer">
                        {!! icon('social/tg')->class('h-[2rem] w-[2rem]') !!}
                    </a>
                @endif
                @if($settings->vk_link)
                    <a href="{{ $settings->vk_link }}" target="_blank" rel="noopener noreferrer">
                        {!! icon('social/vk')->class('h-[2rem] w-[2rem]') !!}
                    </a>
                @endif
            </div>
        </div>
    </div>
</header>
