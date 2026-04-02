<?php

namespace App\Filament\Forms\Components\PublicStatus;

use Filament\Forms\Components\ToggleButtons;

class PublicStatusInput
{
    public static function make(): ToggleButtons
    {
        return ToggleButtons::make('status')
            ->options([
                'published' => 'Опубликовано',
                'private' => 'Личное',
                'draft' => 'Черновик',
            ])
            ->colors([
                'published' => 'success',
                'private' => 'info',
                'draft' => 'warning',
            ])
            ->icons([
                'published' => 'heroicon-o-check-circle',
                'private' => 'heroicon-o-eye',
                'draft' => 'heroicon-o-pencil',
            ])
            ->default('draft')
            ->grouped()
            ->reactive()
            ->label(false)
            ->inline();
    }
}
