<?php

namespace App\Livewire\Auth;

use App\Livewire\Actions\Logout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Component;

/**
 * Компонент страницы «Подтвердите email».
 *
 * Показывается пользователям, которые ещё не подтвердили email. Действия:
 * — отправить письмо с ссылкой повторно (sendVerification);
 * — выйти из аккаунта (logout) с редиректом на главную.
 */
#[Layout('components.layouts.auth')]
class VerifyEmail extends Component
{
    /**
     * Повторная отправка письма с ссылкой для подтверждения email.
     *
     * Если email уже подтверждён — редирект на account. Иначе отправляется
     * уведомление через модель пользователя, в сессию пишется статус для отображения сообщения.
     */
    public function sendVerification(): void
    {
        if (Auth::user()->hasVerifiedEmail()) {
            $this->redirectIntended(default: route('account', absolute: false), navigate: true);

            return;
        }

        Auth::user()->sendEmailVerificationNotification();

        Session::flash('status', 'verification-link-sent');
    }

    /**
     * Выход из аккаунта и редирект на главную.
     *
     * Использует действие Logout для очистки сессии и инвалидации «remember»-токена,
     * затем перенаправляет на фронтенд (главную страницу).
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }
}
