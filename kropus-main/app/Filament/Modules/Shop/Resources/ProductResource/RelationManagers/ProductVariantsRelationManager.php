<?php

namespace App\Filament\Modules\Shop\Resources\ProductResource\RelationManagers;

use App\Filament\Tables\Columns\MultilingualTextColumn;
use App\Filament\Tables\Columns\PublicStatusColumn;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Table;
use Filament\Tables;

class ProductVariantsRelationManager extends RelationManager
{
    protected static string $relationship = 'variants';

    protected static ?string $title = 'Вариации товара';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
            ]);
    }
    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->label('ID'),
                MultilingualTextColumn::make('title')
                    ->limit(50)
                    ->label('Заголовок')
                    ->searchable(),
                Tables\Columns\TextColumn::make('slug')
                    ->label('Слаг'),
                PublicStatusColumn::make()
            ])
            ->searchable(false);
    }
}
