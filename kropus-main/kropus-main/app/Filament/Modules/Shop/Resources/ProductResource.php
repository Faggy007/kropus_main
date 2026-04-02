<?php

namespace App\Filament\Modules\Shop\Resources;

use App\Filament\Forms\Components\FileUpload;
use App\Filament\Forms\Components\MultilingualFieldWrap;
use App\Filament\Forms\Components\Seo\SeoSection;
use App\Filament\Modules\Shop\Resources\ProductResource\Pages;
use App\Filament\Modules\Shop\Resources\ProductResource\RelationManagers\ProductVariantsRelationManager;
use App\Filament\Tables\Columns\MultilingualTextColumn;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Navigation\NavigationItem;
use Filament\Pages\Page;
use Filament\Pages\SubNavigationPosition;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Modules\Shop\Models\Product;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;

    protected static ?string $slug = 'shop/products';

    protected static ?string $navigationGroup = 'Каталог';

    protected static ?string $navigationLabel = 'Товары';

    protected static ?string $pluralModelLabel = 'Товары';

    protected static ?string $modelLabel = 'Товар';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make('Основная информация')->schema([
                            MultilingualFieldWrap::make(
                                Forms\Components\TextInput::make('title')
                                    ->label('Заголовок')
                            ),
                            Forms\Components\TextInput::make('slug')
                                ->rules(['alpha_dash'])
                                ->required()
                                ->label('Слаг'),
                            Forms\Components\Select::make('category')
                                ->label('Категория')
                                ->getOptionLabelFromRecordUsing(fn($record) => $record->getTranslatedField('title'))
                                ->relationship('category', 'title'),
                            MultilingualFieldWrap::make(
                                Forms\Components\Textarea::make('description')
                                    ->label('Описание')
                            ),
                        ]),
                        SeoSection::make(),
                    ])
                    ->columnSpan(['lg' => 5]),
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make()->schema([
                            FileUpload::make('image')
                                ->label('Изображение')
                                ->image()
                        ])
                    ])
                    ->columnSpan(['lg' => 3])
            ])->columns(8);
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
                    ->label('Слаг'),
                Tables\Columns\TextColumn::make('category')
                    ->label('Категория')
                    ->getStateUsing(fn(Product $record) => $record->category?->getTranslatedField('title')),
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

    public static function getRecordSubNavigation(Page $page): array
    {
        $items = $page->generateNavigationItems([
            Pages\EditProduct::class,
            Pages\EditProductModifiers::class,
            Pages\EditProductAttributes::class,
            Pages\EditProductGallery::class,
            Pages\EditProductInfoTabs::class
        ]);

        return array_map(function (NavigationItem $item) {
            $item->icon(null);
            return $item;
        }, $items);
    }

    public static function getRelations(): array
    {
        return [
            ProductVariantsRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
            'edit-attributes' => Pages\EditProductAttributes::route('/{record}/edit-attributes'),
            'edit-modifiers' => Pages\EditProductModifiers::route('/{record}/edit-modifiers'),
            'edit-gallery' => Pages\EditProductGallery::route('/{record}/edit-gallery'),
            'edit-info-tabs' => Pages\EditProductInfoTabs::route('/{record}/edit-info-tabs')
        ];
    }
}
