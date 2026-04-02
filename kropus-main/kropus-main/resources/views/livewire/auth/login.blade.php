{{-- Страница входа: форма email + пароль, «запомнить меня», ссылки «Забыли пароль» и «Регистрация». --}}
<div class="flex flex-col gap-6">
    {{-- Заголовок и подзаголовок страницы --}}
    <x-auth-header title="Вход в аккаунт" description="Введите email и пароль для входа" />

    {{-- Сообщения из сессии (успех, ошибка и т.п.) --}}
    <x-auth-session-status class="text-center" :status="session('status')" />

    {{-- Форма отправляется в Livewire-метод login() --}}
    <form wire:submit="login" class="flex flex-col gap-6">
        {{-- Поле email: привязка к $email, вывод ошибок валидации --}}
        <div class="form-control-wrap">
            <label class="form-control-label" for="login-email">Email</label>
            <input
                id="login-email"
                class="form-control-input"
                wire:model="email"
                type="email"
                required
                autofocus
                autocomplete="email"
                placeholder="email@example.com"
            />
            @error('email')
                <span class="form-control-error">{{ $message }}</span>
            @enderror
        </div>

        {{-- Поле пароля + ссылка «Забыли пароль» (если маршрут зарегистрирован) --}}
        <div class="form-control-wrap">
            <div class="flex justify-between items-center mb-3">
                <label class="form-control-label mb-0" for="login-password">Пароль</label>
                @if (Route::has('password.request'))
                    <a class="text-primary underline hover:no-underline" href="{{ route('password.request') }}" wire:navigate>
                        Забыли пароль?
                    </a>
                @endif
            </div>
            <input
                id="login-password"
                class="form-control-input"
                wire:model="password"
                type="password"
                required
                autocomplete="current-password"
                placeholder="Пароль"
            />
            @error('password')
                <span class="form-control-error">{{ $message }}</span>
            @enderror
        </div>

        {{-- Чекбокс «Запомнить меня» — привязка к $remember для продления сессии --}}
        <div class="flex items-center">
            <input
                id="login-remember"
                class="mr-4 accent-primary w-[1.625rem] h-[1.625rem]"
                type="checkbox"
                wire:model="remember"
            />
            <label class="text-3 text-[#7C7C7C]" for="login-remember">Запомнить меня</label>
        </div>

        <div class="flex items-center justify-end">
            <button type="submit" class="btn btn-primary w-full">Войти</button>
        </div>
    </form>

    {{-- Ссылка на регистрацию (показывается, если маршрут register существует) --}}
    @if (Route::has('register'))
        <div class="space-x-1 rtl:space-x-reverse text-center text-[#7C7C7C]">
            Нет аккаунта?
            <a class="text-primary underline hover:no-underline" href="{{ route('register') }}" wire:navigate>Зарегистрироваться</a>
        </div>
    @endif
</div>
