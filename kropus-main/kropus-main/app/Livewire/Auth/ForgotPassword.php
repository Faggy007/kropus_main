<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Password;
use Livewire\Attributes\Layout;
use Livewire\Component;

/**
 * Компонент страницы «Забыли пароль».
 *
 * Пользователь вводит email; система отправляет ссылку для сброса пароля на этот адрес
 * (если аккаунт с таким email существует). Сообщение в сессии не раскрывает, есть ли аккаунт.
 */
#[Layout('components.layouts.auth')]
class ForgotPassword extends Component
{
    /** Email, на который отправить ссылку для сброса пароля. */
    public string $email = '';

    /**
     * Отправка ссылки для сброса пароля.
     *
     * Валидирует email, вызывает стандартный механизм Laravel Password::sendResetLink().
     * В сессию записывается нейтральное сообщение (не выдаём информацию о существовании аккаунта).
     */
    public function sendPasswordResetLink(): void
    {
        $this->validate([
            'email' => ['required', 'string', 'email'],
        ]);

        Password::sendResetLink($this->only('email'));

        session()->flash('status', 'Ссылка для сброса пароля будет отправлена на указанный email, если аккаунт существует.');
    }
}
