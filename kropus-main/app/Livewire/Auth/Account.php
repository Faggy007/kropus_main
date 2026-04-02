<?php

namespace App\Livewire\Auth;

use Livewire\Attributes\Layout;
use Livewire\Component;

/**
 * Компонент страницы «Аккаунт»: отображение данных текущего пользователя и кнопка выхода.
 *
 * Доступен только авторизованным пользователям. Показывает имя и email из Auth::user(),
 * кнопка «Выйти» отправляет POST на маршрут logout (действие Logout).
 */
#[Layout('components.layouts.auth')]
class Account extends Component
{
    /**
     * Рендер страницы: данные пользователя берутся из Auth::user() в шаблоне.
     */
    public function render()
    {
        return view('livewire.auth.account');
    }
}
