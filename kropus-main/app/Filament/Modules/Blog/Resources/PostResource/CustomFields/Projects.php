<?php

namespace App\Filament\Modules\Blog\Resources\PostResource\CustomFields;

use App\Filament\Forms\Components\MultilingualFieldWrap;
use Filament\Forms;

class Projects
{
    public static function make(): Forms\Components\Group
    {
        return Forms\Components\Group::make([
            MultilingualFieldWrap::make(Forms\Components\Textarea::make('task_description')->label('Описание задачи'))->columnSpanFull(),
        ])->statePath('fields');
    }
}
