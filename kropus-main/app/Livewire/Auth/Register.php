<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Component;

/**
 * Компонент страницы регистрации нового пользователя.
 *
 * Форма: имя, email, пароль, подтверждение пароля, чекбокс согласия с политикой конфиденциальности.
 * После валидации создаёт пользователя, отправляет событие Registered, логинит и редиректит на account.
 */
#[Layout('components.layouts.auth')]
class Register extends Component
{
    /** Имя (ФИО) пользователя. */
    public string $name = '';

    /** Email для входа и уведомлений. */
    public string $email = '';

    /** Пароль. */
    public string $password = '';

    /** Повтор пароля для проверки. */
    public string $password_confirmation = '';

    /** Согласие на обработку персональных данных (обязательный чекбокс). */
    public bool $accept_privacy = false;

    /**
     * Обработка регистрации.
     *
     * Валидирует данные (включая уникальность email и правила сложности пароля),
     * хеширует пароль, создаёт пользователя, отправляет событие Registered,
     * авторизует пользователя и перенаправляет на account.
     */
    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
            'accept_privacy' => ['required', 'accepted'],
        ]);

        $validated['password'] = Hash::make($validated['password']);
        // В таблицу users не передаём подтверждение пароля и флаг согласия.
        unset($validated['password_confirmation'], $validated['accept_privacy']);

        event(new Registered(($user = User::create($validated))));

        Auth::login($user);

        $this->redirect(route('home', absolute: false), navigate: true);
    }
}
