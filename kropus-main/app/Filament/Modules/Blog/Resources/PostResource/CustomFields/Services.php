<?php

namespace App\Filament\Modules\Blog\Resources\PostResource\CustomFields;

use App\Filament\Forms\Components\FileUpload;
use App\Filament\Forms\Components\MultilingualFieldWrap;
use Filament\Forms;

class Services
{
    public static function make(): Forms\Components\Group
    {
        return Forms\Components\Group::make([
            MultilingualFieldWrap::make(Forms\Components\TextInput::make('short_title')->label('Короткий заголовок'))->columnSpanFull(),
            FileUpload::make('service_icon')
                ->acceptedFileTypes(['image/svg+xml'])
                ->label('Иконка услуги')
                ->columnSpanFull(),
            Forms\Components\Checkbox::make('show_image_on_page')
                ->label('Показать изображение на странице')
                ->default(true)
                ->columnSpanFull(),
        ])->statePath('fields');
    }
}
