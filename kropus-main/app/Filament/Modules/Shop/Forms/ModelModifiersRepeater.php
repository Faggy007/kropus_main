<?php

namespace App\Filament\Modules\Shop\Forms;

use Filament\Forms;
use Modules\Shop\Models\Modifier;

class ModelModifiersRepeater
{
    public static function make(): Forms\Components\Group
    {
        return Forms\Components\Group::make([
            Forms\Components\Repeater::make('modifiers')
                ->collapsed()
                ->relationship('modifiers')
                ->label('Модификаторы')
                ->itemLabel(fn(array $state): ?string => (new self())->itemLabel($state))
                ->schema([
                    Forms\Components\Select::make('modifier_id')
                        ->relationship('modifier', 'title')
                        ->label('Модификатор')
                        ->getOptionLabelFromRecordUsing(fn(Modifier $record) => $record->getTranslatedField('title'))
                        ->preload()
                        ->searchable()
                        ->reactive(),
                ])
                ->defaultItems(0)
                ->addActionLabel('Добавить модификатор'),
        ]);
    }

    private function itemLabel(array $state): ?string
    {
        $attribute = Modifier::find($state['modifier_id'] ?? null);
        return $attribute ? $attribute->getTranslatedField('title') : '';
    }
}
