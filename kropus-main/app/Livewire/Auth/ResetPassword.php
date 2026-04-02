<?php

namespace App\Livewire\Auth;

use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Locked;
use Livewire\Component;

/**
 * Компонент страницы установки нового пароля после перехода по ссылке из письма.
 *
 * Принимает token и email из URL (mount), форма передаёт новый пароль и подтверждение.
 * При успешном сбросе обновляет пароль и remember_token у пользователя, отправляет событие
 * PasswordReset, пишет статус в сессию и редиректит на страницу входа.
 */
#[Layout('components.layouts.auth')]
class ResetPassword extends Component
{
    /** Токен сброса пароля из ссылки в письме (не меняется после загрузки компонента). */
    #[Locked]
    public string $token = '';

    /** Email пользователя (берётся из query-параметра URL). */
    public string $email = '';

    /** Новый пароль. */
    public string $password = '';

    /** Подтверждение нового пароля. */
    public string $password_confirmation = '';

    /**
     * Инициализация компонента: сохраняем token из маршрута и email из query-строки.
     */
    public function mount(string $token): void
    {
        $this->token = $token;

        $this->email = request()->string('email');
    }

    /**
     * Сброс пароля по токену и email.
     *
     * Валидирует token, email и пароль (с правилами сложности). Вызывает Password::reset():
     * при валидном токене обновляет пароль и remember_token у пользователя, отправляет
     * событие PasswordReset. При ошибке добавляет ошибку к полю email; при успехе —
     * flash-сообщение в сессию и редирект на login.
     */
    public function resetPassword(): void
    {
        $this->validate([
            'token' => ['required'],
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $status = Password::reset(
            $this->only('email', 'password', 'password_confirmation', 'token'),
            function ($user) {
                $user->forceFill([
                    'password' => Hash::make($this->password),
                    'remember_token' => Str::random(60),
                ])->save();

                event(new PasswordReset($user));
            }
        );

        if ($status != Password::PasswordReset) {
            $this->addError('email', match ($status) {
                'passwords.token' => 'Недействительная ссылка для сброса пароля. Запросите новую.',
                'passwords.user' => 'Пользователь с таким email не найден.',
                default => 'Не удалось сбросить пароль. Попробуйте ещё раз или запросите новую ссылку.',
            });

            return;
        }

        Session::flash('status', 'Пароль успешно сброшен. Войдите с новым паролем.');

        $this->redirectRoute('login', navigate: true);
    }
}
