<?php

namespace App\Livewire\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;

/**
 * Компонент страницы входа в аккаунт.
 *
 * Отображает форму логина (email, пароль, «запомнить меня»), проверяет учётные данные,
 * ограничивает количество попыток входа (rate limiting) и при успехе перенаправляет на account.
 */
#[Layout('components.layouts.auth')]
class Login extends Component
{
    /** Email пользователя для входа. */
    #[Validate('required|string|email')]
    public string $email = '';

    /** Пароль пользователя. */
    #[Validate('required|string')]
    public string $password = '';

    /** Флаг «запомнить меня» — продлевает время жизни сессии. */
    public bool $remember = false;

    /**
     * Обработка запроса на вход.
     *
     * Валидирует поля, проверяет лимит попыток, пытается авторизовать пользователя.
     * При неудаче — начисляет попытку в rate limiter и выбрасывает ошибку.
     * При успехе — сбрасывает счётчик попыток, перегенерирует сессию и редирект на account.
     */
    public function login(): void
    {
        $this->validate();

        // Проверяем, не превышен ли лимит попыток входа с этого email/IP.
        $this->ensureIsNotRateLimited();

        // Пытаемся войти по email и паролю; при необходимости «запомнить» продлеваем сессию.
        if (! Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'email' => 'Неверный email или пароль.',
            ]);
        }

        // Успешный вход: сбрасываем счётчик попыток и перегенерируем ID сессии (защита от фиксации).
        RateLimiter::clear($this->throttleKey());
        Session::regenerate();

        $this->redirectIntended(default: route('account', absolute: false), navigate: true);
    }

    /**
     * Проверка, что запрос не заблокирован из-за превышения лимита попыток.
     *
     * Допускается 5 попыток. При превышении — событие Lockout и исключение с сообщением
     * и временем до разблокировки (в секундах и минутах).
     */
    protected function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout(request()));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        $minutes = ceil($seconds / 60);
        throw ValidationException::withMessages([
            'email' => "Слишком много попыток входа. Попробуйте снова через {$seconds} сек. ({$minutes} мин.).",
        ]);
    }

    /**
     * Ключ для rate limiter: комбинация email и IP.
     *
     * Email приводится к нижнему регистру и транслитерируется, чтобы один пользователь
     * не блокировался разными написаниями одного и того же email.
     */
    protected function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->email).'|'.request()->ip());
    }
}
