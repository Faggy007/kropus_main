<?php

namespace App\Filament\Modules\Shop\Forms;

use Filament\Forms;
use Filament\Forms\Get;
use Modules\Shop\Models\Attribute;
use Modules\Shop\Models\AttributeOption;
use Modules\Shop\Models\AttributeType;

class ModelAttributesRepeater
{
    public static function make(): Forms\Components\Group
    {
        return  Forms\Components\Group::make([
            Forms\Components\Repeater::make('attributes')
                ->collapsed()
                ->relationship('attributes')
                ->label('Атрибуты')
                ->itemLabel(fn (array $state): ?string => (new self())->itemLabel($state))
                ->schema([
                    Forms\Components\Select::make('attribute_id')
                        ->relationship('attribute', 'title')
                        ->label('Атрибут')
                        ->getOptionLabelFromRecordUsing(fn(Attribute $record) => $record->getTranslatedField('title'))
                        ->preload()
                        ->searchable()
                        ->reactive(),
                    Forms\Components\TextInput::make('text_value')
                        ->label('Значение')
                        ->required()
                        ->reactive()
                        ->visible(self::getByAttributeType(AttributeType::TEXT)),
                    Forms\Components\TextInput::make('numeric_value')
                        ->numeric()
                        ->label('Значение')
                        ->required()
                        ->reactive()
                        ->visible(self::getByAttributeType(AttributeType::NUMBER)),
                    Forms\Components\Select::make('option_id')
                        ->label('Значение')
                        ->searchable()
                        ->reactive()
                        ->options(function (Get $get) {
                            $attribute = Attribute::find($get('attribute_id'));
                            if ($attribute) {
                                return $attribute->options->mapWithKeys(function (AttributeOption $option) {
                                    return [$option->id => $option->getTranslatedField('title')];
                                });
                            }
                            return [];
                        })
                        ->visible(self::getByAttributeType(AttributeType::OPTIONS))
                ])
                ->defaultItems(0)
                ->addActionLabel('Добавить атрибут'),
        ]);
    }

    private static function getByAttributeType(AttributeType $type): callable
    {
        return function (Get $get) use ($type) {
            $attribute = Attribute::find($get('attribute_id'));
            return $attribute?->type === $type;
        };
    }

    private function itemLabel(array $state): ?string
    {
        $attribute = Attribute::find($state['attribute_id'] ?? null);
        return $attribute ? $attribute->getTranslatedField('title') : '';
    }
}
