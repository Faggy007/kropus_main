<?php

namespace App\Filament\Pages;

use Filament\Forms;
use Filament\Forms\ComponentContainer;
use Filament\Forms\Form;
use Filament\Pages\SettingsPage;
use Modules\ContactForm\Settings\ContactFormSettings;

class ManageContactForm extends SettingsPage
{
    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static string $settings = ContactFormSettings::class;

    protected static ?string $navigationLabel = 'Контактные формы';

    protected static ?string $title = 'Настройки контактных форм';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Основные')->schema([
                    Forms\Components\Repeater::make('notification_emails')
                        ->label('Email для уведомлений')
                        ->simple(Forms\Components\TextInput::make('email')->email()),
                ]),
            ])->columns(1);
    }

    public function currentlyValidatingForm(?ComponentContainer $form): void
    {
        // TODO: Implement currentlyValidatingForm() method.
    }
}
