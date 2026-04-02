{{-- Страница регистрации: имя, email, пароль, подтверждение пароля, согласие с политикой конфиденциальности. --}}
<div class="flex flex-col gap-6">
    {{-- Заголовок и подзаголовок страницы --}}
    <x-auth-header title="Создать аккаунт" description="Заполните данные для регистрации" />

    {{-- Сообщения из сессии (успех, ошибка) --}}
    <x-auth-session-status class="text-center" :status="session('status')" />

    {{-- Форма отправляется в Livewire-метод register() --}}
    <form wire:submit="register" class="flex flex-col gap-6">
        {{-- Имя пользователя — привязка к $name --}}
        <div class="form-control-wrap">
            <label class="form-control-label" for="register-name">Имя</label>
            <input
                id="register-name"
                class="form-control-input"
                wire:model="name"
                type="text"
                required
                autofocus
                autocomplete="name"
                placeholder="ФИО"
            />
            @error('name')
                <span class="form-control-error">{{ $message }}</span>
            @enderror
        </div>

        {{-- Email — привязка к $email, проверка уникальности на бэкенде --}}
        <div class="form-control-wrap">
            <label class="form-control-label" for="register-email">Email</label>
            <input
                id="register-email"
                class="form-control-input"
                wire:model="email"
                type="email"
                required
                autocomplete="email"
                placeholder="email@example.com"
            />
            @error('email')
                <span class="form-control-error">{{ $message }}</span>
            @enderror
        </div>

        {{-- Пароль — привязка к $password, правила сложности в Livewire --}}
        <div class="form-control-wrap">
            <label class="form-control-label" for="register-password">Пароль</label>
            <input
                id="register-password"
                class="form-control-input"
                wire:model="password"
                type="password"
                required
                autocomplete="new-password"
                placeholder="Пароль"
            />
            @error('password')
                <span class="form-control-error">{{ $message }}</span>
            @enderror
        </div>

        {{-- Подтверждение пароля — должно совпадать с полем выше (правило confirmed) --}}
        <div class="form-control-wrap">
            <label class="form-control-label" for="register-password-confirmation">Подтвердите пароль</label>
            <input
                id="register-password-confirmation"
                class="form-control-input"
                wire:model="password_confirmation"
                type="password"
                required
                autocomplete="new-password"
                placeholder="Подтвердите пароль"
            />
            @error('password_confirmation')
                <span class="form-control-error">{{ $message }}</span>
            @enderror
        </div>

        {{-- Обязательное согласие с политикой конфиденциальности — привязка к $accept_privacy, ссылка на страницу политики --}}
        <div class="flex">
            <input
                class="mr-4 accent-primary w-[1.625rem] h-[1.625rem]"
                required
                type="checkbox"
                id="register-accept-privacy"
                wire:model="accept_privacy"
            />
            <label class="text-3 text-[#7C7C7C]" for="register-accept-privacy">
                Я согласен на обработку моих персональных данных в соответствии с
                <a target="_blank" class="underline hover:text-primary" href="{{ frontend_url('privacy') }}">политикой конфиденциальности</a>.
            </label>
        </div>
        @error('accept_privacy')
            <span class="form-control-error">{{ $message }}</span>
        @enderror

        <div class="flex items-center justify-end">
            <button type="submit" class="btn btn-primary w-full">Создать аккаунт</button>
        </div>
    </form>

    {{-- Ссылка на страницу входа для тех, у кого уже есть аккаунт --}}
    <div class="space-x-1 rtl:space-x-reverse text-center text-[#7C7C7C]">
        Уже есть аккаунт?
        <a class="text-primary underline hover:no-underline" href="{{ route('login') }}" wire:navigate>Войти</a>
    </div>
</div>
