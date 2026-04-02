<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Layout;
use Livewire\Component;

/**
 * Компонент страницы подтверждения пароля.
 *
 * Используется для защиты чувствительных действий: пользователь должен ещё раз ввести пароль.
 * После успешной проверки в сессию записывается время подтверждения (auth.password_confirmed_at),
 * затем редирект на изначально запрошенную страницу или на account.
 */
#[Layout('components.layouts.auth')]
class ConfirmPassword extends Component
{
    /** Текущий пароль пользователя для подтверждения. */
    public string $password = '';

    /**
     * Подтверждение пароля текущего пользователя.
     *
     * Валидирует наличие пароля, проверяет его через guard('web'). При неверном пароле
     * выбрасывает ValidationException. При успехе сохраняет время подтверждения в сессию
     * и выполняет редирект (intended или account).
     */
    public function confirmPassword(): void
    {
        $this->validate([
            'password' => ['required', 'string'],
        ]);

        if (! Auth::guard('web')->validate([
            'email' => Auth::user()->email,
            'password' => $this->password,
        ])) {
            throw ValidationException::withMessages([
                'password' => 'Неверный пароль.',
            ]);
        }

        // Метки времени достаточно для middleware: повторный ввод пароля не требуется до истечения интервала.
        session(['auth.password_confirmed_at' => time()]);

        $this->redirectIntended(default: route('account', absolute: false), navigate: true);
    }
}
