<?php

namespace App\Filament\Modules\Shop\Resources;

use App\Filament\Forms\Components\MultilingualFieldWrap;
use App\Filament\Tables\Columns\MultilingualTextColumn;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Modules\Shop\Models\Unit;
use Filament\Forms;

class UnitResource extends Resource
{
    protected static ?string $model = Unit::class;

    protected static ?string $slug = 'shop/units';

    protected static ?string $navigationGroup = 'Каталог';

    protected static ?string $navigationLabel = 'Единицы измерения';

    protected static ?string $pluralModelLabel = 'Единицы измерения';

    protected static ?string $modelLabel = 'Единица измерения';

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
                    MultilingualFieldWrap::make(
                        Forms\Components\TextInput::make('short_title')
                            ->label('Короткий заголовок')
                            ->required()
                    ),
                    Forms\Components\TextInput::make('slug')
                        ->rules(['alpha_dash'])
                        ->required()
                        ->label('Слаг'),
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
                MultilingualTextColumn::make('short_title')
                    ->limit(50)
                    ->label('Короткий заголовок')
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
            'index' => \App\Filament\Modules\Shop\Resources\UnitResource\Pages\ListUnits::route('/'),
            'create' => \App\Filament\Modules\Shop\Resources\UnitResource\Pages\CreateUnit::route('/create'),
            'edit' => \App\Filament\Modules\Shop\Resources\UnitResource\Pages\EditUnit::route('/{record}/edit'),
        ];
    }
}
