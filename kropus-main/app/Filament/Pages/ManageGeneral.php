<?php

namespace App\Filament\Pages;

use App\Settings\GeneralSettings;
use Filament\Forms;
use Filament\Forms\ComponentContainer;
use Filament\Forms\Form;
use Filament\Pages\SettingsPage;

class ManageGeneral extends SettingsPage
{
    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static string $settings = GeneralSettings::class;

    protected static ?string $title = 'Основные настройки';

    protected static ?string $navigationLabel = 'Основные';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Основные')->schema([
                    Forms\Components\TextInput::make('email')
                        ->label('Email')
                        ->email(),
                    Forms\Components\TextInput::make('phone')
                        ->label('Телефон'),
                    Forms\Components\Textarea::make('address')
                        ->label('Адрес'),
                    Forms\Components\TextInput::make('vk_link')
                        ->label('Ссылка ВКонтакте')
                        ->url(),
                    Forms\Components\TextInput::make('tg_link')
                        ->label('Ссылка Telegram')
                        ->url(),
                    Forms\Components\TextInput::make('max_link')
                        ->label('Ссылка Max')
                        ->url(),
                    Forms\Components\Textarea::make('map_iframe')
                        ->label('Iframe карты'),
                    Forms\Components\TextInput::make('legal_full_name')
                        ->label('Полное юридическое название')
                        ->maxLength(500),
                    Forms\Components\TextInput::make('inn')
                        ->label('ИНН')
                        ->maxLength(32),
                    Forms\Components\TextInput::make('ogrn')
                        ->label('ОГРН')
                        ->maxLength(32),
                ]),
            ])->columns(1);
    }

    public function currentlyValidatingForm(?ComponentContainer $form): void
    {
        // TODO: Implement currentlyValidatingForm() method.
    }
}
