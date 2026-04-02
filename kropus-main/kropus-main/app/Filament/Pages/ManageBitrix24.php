<?php

namespace App\Filament\Pages;

use Filament\Forms;
use Filament\Forms\ComponentContainer;
use Filament\Forms\Form;
use Filament\Pages\SettingsPage;
use Modules\Bitrix24\Settings\Bitrix24Settings;

class ManageBitrix24 extends SettingsPage
{
    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static string $settings = Bitrix24Settings::class;

    protected static ?string $title = 'Настройки Bitrix24';

    protected static ?string $navigationLabel = 'Bitrix24';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Основные')->schema([
                    Forms\Components\TextInput::make('lead_add_endpoint')
                        ->label('Lead Add Endpoint'),
                ]),
            ])->columns(1);
    }

    public function currentlyValidatingForm(?ComponentContainer $form): void
    {
        // TODO: Implement currentlyValidatingForm() method.
    }
}
