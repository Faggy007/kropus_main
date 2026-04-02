<?php

namespace App\Filament\Modules\Shop\Resources;

use App\Filament\Forms\Components\MultilingualFieldWrap;
use App\Filament\Modules\Shop\Forms\ModelAttributesRepeater;
use App\Filament\Resources\ModifierResource\Pages;
use App\Filament\Resources\ModifierResource\RelationManagers;
use App\Filament\Tables\Columns\MultilingualTextColumn;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Modules\Shop\Models\Modifier;

class ModifierResource extends Resource
{
    protected static ?string $model = Modifier::class;

    protected static ?string $slug = 'shop/modifiers';

    protected static ?string $navigationGroup = 'Каталог';

    protected static ?string $navigationLabel = 'Модификаторы';

    protected static ?string $pluralModelLabel = 'Модификаторы';

    protected static ?string $modelLabel = 'Модификатор';

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
                ]),
                Forms\Components\Repeater::make('options')
                    ->collapsed()
                    ->itemLabel(fn(array $state): ?string => $state['title'][locale()] ?? null)
                    ->columnSpanFull()
                    ->addActionLabel('Добавить вариант')
                    ->minItems(1)
                    ->defaultItems(0)
                    ->label('Варианты')
                    ->relationship('options')
                    ->schema([
                        MultilingualFieldWrap::make(
                            Forms\Components\TextInput::make('title')
                                ->label('Заголовок')
                                ->required()
                                ->maxLength(255),
                        ),
                        Forms\Components\TextInput::make('slug')
                            ->rules(['alpha_dash'])
                            ->required()
                            ->label('Слаг'),
                        ModelAttributesRepeater::make(),
                    ])
                    ->orderColumn('order'),
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
            'index' => \App\Filament\Modules\Shop\Resources\ModifierResource\Pages\ListModifiers::route('/'),
            'create' => \App\Filament\Modules\Shop\Resources\ModifierResource\Pages\CreateModifier::route('/create'),
            'edit' => \App\Filament\Modules\Shop\Resources\ModifierResource\Pages\EditModifier::route('/{record}/edit'),
        ];
    }
}
