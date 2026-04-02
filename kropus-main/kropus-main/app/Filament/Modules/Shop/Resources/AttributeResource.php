<?php

namespace App\Filament\Modules\Shop\Resources;

use App\Filament\Forms\Components\MultilingualFieldWrap;
use App\Filament\Tables\Columns\MultilingualTextColumn;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Modules\RealEstate\Models\UnitCategory;
use Modules\Shop\Models\Attribute;
use Modules\Shop\Models\AttributeType;
use Modules\Shop\Models\Unit;

class AttributeResource extends Resource
{
    protected static ?string $model = Attribute::class;

    protected static ?string $slug = 'shop/attributes';

    protected static ?string $navigationGroup = 'Каталог';

    protected static ?string $navigationLabel = 'Атрибуты';

    protected static ?string $pluralModelLabel = 'Атрибуты';

    protected static ?string $modelLabel = 'Атрибут';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Основная информация')->schema([
                    MultilingualFieldWrap::make(
                        Forms\Components\TextInput::make('title')
                            ->label('Заголовок')
                            ->required()
                    ),
                    Forms\Components\TextInput::make('slug')
                        ->rules(['alpha_dash'])
                        ->required()
                        ->label('Слаг'),
                    Forms\Components\Select::make('type')
                        ->label('Тип')
                        ->options(AttributeType::labels())
                        ->reactive()
                        ->required(),
                    Forms\Components\Select::make('unit')
                        ->label('Единица измерения')
                        ->relationship('unit', 'title')
                        ->getOptionLabelFromRecordUsing(fn(Unit $record) => $record->getTranslatedField('title'))
                        ->preload()
                        ->searchable()
                        ->reactive()
                ]),
                Forms\Components\Section::make('Варианты выбора')
                    ->reactive()
                    ->visible(fn(Get $get) => $get('type') === AttributeType::OPTIONS->value)
                    ->schema([
                        Forms\Components\Repeater::make('options')
                            ->addActionLabel('Добавить вариант')
                            ->minItems(1)
                            ->defaultItems(0)
                            ->label(false)
                            ->relationship('options')
                            ->schema([
                                MultilingualFieldWrap::make(
                                    Forms\Components\TextInput::make('title')
                                        ->label('Заголовок')
                                        ->required()
                                        ->maxLength(255)
                                ),
                                Forms\Components\TextInput::make('slug')
                                    ->rules(['alpha_dash'])
                                    ->required()
                                    ->label('Слаг'),
                            ])
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->label('ID'),
                MultilingualTextColumn::make('title')
                    ->limit(50)
                    ->label('Заголовок')
                    ->searchable(),
                Tables\Columns\TextColumn::make('type')
                    ->label('Тип')
                    ->getStateUsing(fn(Attribute $record) => $record->type->label()),
                Tables\Columns\TextColumn::make('unit')
                    ->label('Единица измерения')
                    ->getStateUsing(fn(Attribute $record) => $record->unit?->getTranslatedField('title')),
                Tables\Columns\TextColumn::make('slug')
                    ->label('Слаг')

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => \App\Filament\Modules\Shop\Resources\AttributeResource\Pages\ListAttributes::route('/'),
            'create' => \App\Filament\Modules\Shop\Resources\AttributeResource\Pages\CreateAttribute::route('/create'),
            'edit' => \App\Filament\Modules\Shop\Resources\AttributeResource\Pages\EditAttribute::route('/{record}/edit'),
        ];
    }
}
