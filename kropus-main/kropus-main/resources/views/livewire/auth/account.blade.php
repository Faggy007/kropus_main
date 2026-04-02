{{-- Страница аккаунта: данные текущего пользователя и кнопка выхода. --}}
<div class="flex flex-col gap-6">
    {{-- Заголовок страницы --}}
    <x-auth-header title="Мой аккаунт" description="Информация о вашем профиле" />

    {{-- Карточка с данными пользователя (имя, email) --}}
    <div class="rounded-lg border border-[#E2E6EC] bg-white p-6">
        <dl class="flex flex-col gap-4">
            <div>
                <dt class="text-3 text-[#7C7C7C] mb-1">Имя</dt>
                <dd class="form-control-label mb-0">{{ Auth::user()->name }}</dd>
            </div>
            <div>
                <dt class="text-3 text-[#7C7C7C] mb-1">Email</dt>
                <dd class="form-control-label mb-0">{{ Auth::user()->email }}</dd>
            </div>
        </dl>
    </div>

    {{-- Выход: форма POST на маршрут logout (CSRF обязателен) --}}
    <form action="{{ route('logout') }}" method="POST" class="flex justify-end">
        @csrf
        <button type="submit" class="btn btn-primary w-full">
            Выйти
        </button>
    </form>
</div>
