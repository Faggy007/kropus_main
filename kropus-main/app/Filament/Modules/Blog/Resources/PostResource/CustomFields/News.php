<?php

namespace App\Filament\Modules\Blog\Resources\PostResource\CustomFields;

use Filament\Forms;

class News
{
    public static function make(): Forms\Components\Group
    {
        return Forms\Components\Group::make([
            Forms\Components\Checkbox::make('show_image_on_page')
                ->label('Показать изображение на странице')
                ->default(true)
                ->columnSpanFull(),
        ])->statePath('fields');
    }
}
