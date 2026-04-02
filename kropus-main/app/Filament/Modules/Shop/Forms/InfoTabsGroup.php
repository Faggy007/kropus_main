<?php

namespace App\Filament\Modules\Shop\Forms;

use App\Filament\Forms\Components\MultilingualFieldWrap;
use Filament\Forms;
use FilamentTiptapEditor\Enums\TiptapOutput;
use FilamentTiptapEditor\TiptapEditor;

class InfoTabsGroup
{
    public static function make(): Forms\Components\Group
    {
        return  Forms\Components\Group::make([
            Forms\Components\Repeater::make('items')
            ->relationship('infoTabs')
            ->collapsed()
            ->minItems(0)
            ->defaultItems(0)
            ->label('Информационные вкладки')
            ->itemLabel(fn (array $state): ?string => $state['title'][locale()] ?? 'Информационная вкладка')
            ->distinct('slug')
            ->addActionLabel('Добавить вкладку')
            ->schema([
                Forms\Components\TextInput::make('slug')
                    ->rules(['alpha_dash'])
                    ->required()
                    ->label('Слаг'),
                MultilingualFieldWrap::make(
                    Forms\Components\TextInput::make('title')
                        ->label('Заголовок')
                        ->required()
                        ->maxLength(255)
                ),
                MultilingualFieldWrap::make(
                    TiptapEditor::make('content_schema')
                        ->label('Контент')
                        ->output(TiptapOutput::Json)
                ),
            ])
            ->orderColumn('order')
        ]);
    }
}
