{{-- Страница сброса пароля: открывается по ссылке из письма (token + email в URL). Форма — новый пароль и подтверждение. --}}
<div class="flex flex-col gap-6">
    {{-- Заголовок и подзаголовок страницы --}}
    <x-auth-header title="Сброс пароля" description="Введите новый пароль" />

    {{-- Сообщения из сессии (успех сброса или ошибка) --}}
    <x-auth-session-status class="text-center" :status="session('status')" />

    {{-- Форма отправляется в Livewire-метод resetPassword(); token и email приходят из маршрута/query --}}
    <form wire:submit="resetPassword" class="flex flex-col gap-6">
        {{-- Email пользователя (подставляется из URL, можно скорректировать) — привязка к $email --}}
        <div class="form-control-wrap">
            <label class="form-control-label" for="reset-email">Email</label>
            <input
                id="reset-email"
                class="form-control-input"
                wire:model="email"
                type="email"
                required
                autocomplete="email"
            />
            @error('email')
                <span class="form-control-error">{{ $message }}</span>
            @enderror
        </div>

        {{-- Новый пароль — привязка к $password, правила сложности в Livewire --}}
        <div class="form-control-wrap">
            <label class="form-control-label" for="reset-password">Пароль</label>
            <input
                id="reset-password"
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

        {{-- Подтверждение нового пароля — правило confirmed --}}
        <div class="form-control-wrap">
            <label class="form-control-label" for="reset-password-confirmation">Подтвердите пароль</label>
            <input
                id="reset-password-confirmation"
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

        <div class="flex items-center justify-end">
            <button type="submit" class="btn btn-primary w-full">Сбросить пароль</button>
        </div>
    </form>
</div>
