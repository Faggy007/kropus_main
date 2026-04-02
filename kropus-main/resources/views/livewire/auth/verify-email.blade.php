{{-- Страница «Подтвердите email»: текст-инструкция, повторная отправка письма, выход из аккаунта. --}}
<div class="mt-4 flex flex-col gap-6">
    {{-- Инструкция: пользователь должен перейти по ссылке из письма --}}
    <p class="text-center text-2">
        Перейдите по ссылке из письма, чтобы подтвердить email.
    </p>

    {{-- Сообщение после повторной отправки письма (статус verification-link-sent из Livewire) --}}
    @if (session('status') == 'verification-link-sent')
        <p class="text-center font-medium text-green-600">
            Новая ссылка для подтверждения отправлена на указанный при регистрации email.
        </p>
    @endif

    <div class="flex flex-col items-center justify-between gap-3">
        {{-- Кнопка вызывает Livewire-метод sendVerification() — отправка письма с ссылкой снова --}}
        <button type="button" wire:click="sendVerification" class="btn btn-primary w-full">
            Отправить письмо повторно
        </button>

        {{-- Выход из аккаунта — вызывает logout(), редирект на главную --}}
        <button type="button" class="text-primary underline hover:no-underline cursor-pointer bg-transparent border-0 p-0 font-inherit" wire:click="logout">
            Выйти
        </button>
    </div>
</div>
