{{-- Страница «Забыли пароль»: ввод email для отправки ссылки на сброс пароля. --}}
<div class="flex flex-col gap-6">
    {{-- Заголовок и подзаголовок страницы --}}
    <x-auth-header title="Восстановление пароля" description="Введите email для получения ссылки для сброса пароля" />

    {{-- Сообщения из сессии (например, «письмо отправлено, если аккаунт существует») --}}
    <x-auth-session-status class="text-center" :status="session('status')" />

    {{-- Форма отправляется в Livewire-метод sendPasswordResetLink() — отправка письма со ссылкой --}}
    <form wire:submit="sendPasswordResetLink" class="flex flex-col gap-6">
        {{-- Email, на который отправить ссылку для сброса — привязка к $email --}}
        <div class="form-control-wrap">
            <label class="form-control-label" for="forgot-email">Email</label>
            <input
                id="forgot-email"
                class="form-control-input"
                wire:model="email"
                type="email"
                required
                autofocus
                placeholder="email@example.com"
            />
            @error('email')
                <span class="form-control-error">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary w-full">Отправить ссылку для сброса пароля</button>
    </form>

    {{-- Ссылка вернуться на страницу входа --}}
    <div class="space-x-1 rtl:space-x-reverse text-center text-[#7C7C7C]">
        Или
        <a class="text-primary underline hover:no-underline" href="{{ route('login') }}" wire:navigate>войти</a>
    </div>
</div>
