{{-- Страница подтверждения пароля: повторный ввод пароля перед доступом к защищённому действию. --}}
<div class="flex flex-col gap-6">
    {{-- Заголовок и подзаголовок — объясняют, зачем нужен ввод пароля --}}
    <x-auth-header
        title="Подтверждение пароля"
        description="Подтвердите пароль для продолжения."
    />

    {{-- Сообщения из сессии --}}
    <x-auth-session-status class="text-center" :status="session('status')" />

    {{-- Форма отправляется в Livewire-метод confirmPassword() — проверка пароля и запись времени подтверждения в сессию --}}
    <form wire:submit="confirmPassword" class="flex flex-col gap-6">
        {{-- Текущий пароль пользователя — привязка к $password, проверка на бэкенде --}}
        <div class="form-control-wrap">
            <label class="form-control-label" for="confirm-password">Пароль</label>
            <input
                id="confirm-password"
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

        <button type="submit" class="btn btn-primary w-full">Подтвердить</button>
    </form>
</div>
