<?php

namespace App\Filament\Modules\Blog\Resources\PostResource\CustomFields;

use Filament\Forms;
use Filament\Resources\Pages\CreateRecord;
use Filament\Resources\Pages\EditRecord;

class CustomFields
{
    public static function make(): Forms\Components\Section
    {
        return Forms\Components\Section::make('Дополнительные поля')
            ->schema([
                Home::make()->visible(function (EditRecord|CreateRecord $livewire) {
                    return $livewire->record?->slug === 'home';
                }),
                News::make()->visible(function (EditRecord|CreateRecord $livewire) {
                    return $livewire->record?->category?->slug === 'news';
                }),
                Services::make()->visible(function (EditRecord|CreateRecord $livewire) {
                    return $livewire->record?->category?->slug === 'services';
                }),
                Projects::make()->visible(function (EditRecord|CreateRecord $livewire) {
                    return $livewire->record?->category?->slug === 'projects';
                }),
            ])
            ->relationship('customFields');
    }
}
