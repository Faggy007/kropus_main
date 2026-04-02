<?php

namespace App\Filament\Modules\Shop\Resources;

use App\Filament\Forms\Components\MultilingualFieldWrap;
use App\Filament\Forms\Components\Seo\SeoSection;
use App\Filament\Resources\CategoryResource\Pages;
use App\Filament\Resources\CategoryResource\RelationManagers;
use App\Filament\Tables\Columns\MultilingualTextColumn;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Modules\Shop\Models\Category;

class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;

    protected static ?string $slug = 'shop/categories';

    protected static ?string $navigationGroup = 'Каталог';

    protected static ?string $navigationLabel = 'Категории';

    protected static ?string $pluralModelLabel = 'Категории';

    protected static ?string $modelLabel = 'Категория';

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
                    MultilingualFieldWrap::make(
                        Forms\Components\Textarea::make('description')
                            ->label('Описание')
                    ),
                ]),
                SeoSection::make(),
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
            'index' => \App\Filament\Modules\Shop\Resources\CategoryResource\Pages\ListCategories::route('/'),
            'create' => \App\Filament\Modules\Shop\Resources\CategoryResource\Pages\CreateCategory::route('/create'),
            'edit' => \App\Filament\Modules\Shop\Resources\CategoryResource\Pages\EditCategory::route('/{record}/edit'),
        ];
    }
}
