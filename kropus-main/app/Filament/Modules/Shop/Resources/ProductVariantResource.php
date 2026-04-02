<?php

namespace App\Filament\Modules\Shop\Resources;

use App\Filament\Actions\PublicStatus\ChangePublicStatusBulkAction;
use App\Filament\Forms\Components\FileUpload;
use App\Filament\Forms\Components\MultilingualFieldWrap;
use App\Filament\Forms\Components\PublicStatus\PublicStatusSection;
use App\Filament\Resources\ProductVariantResource\Pages;
use App\Filament\Resources\ProductVariantResource\RelationManagers;
use App\Filament\Tables\Columns\MultilingualTextColumn;
use App\Filament\Tables\Columns\PublicStatusColumn;
use Modules\Shop\Models\ModelAttribute;
use Modules\Shop\Models\ProductVariant;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms;
use Modules\Shop\Services\AttributeValueHumanizer\Humanizer;

class ProductVariantResource extends Resource
{
    protected static ?string $model = ProductVariant::class;

    protected static ?string $slug = 'shop/product-variants';

    protected static ?string $navigationGroup = 'Каталог';

    protected static ?string $navigationLabel = 'Вариации товара';

    protected static ?string $pluralModelLabel = 'Вариации товара';

    protected static ?string $modelLabel = 'Вариация товара';

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
                                    ->readOnly()
                                    ->label('Заголовок')
                            ),
                            Forms\Components\TextInput::make('slug')
                                ->rules(['alpha_dash'])
                                ->required()
                                ->readOnly()
                                ->label('Слаг'),
                            MultilingualFieldWrap::make(
                                Forms\Components\Textarea::make('description')
                                    ->readOnly()
                                    ->label('Описание')
                            ),
                            Forms\Components\KeyValue::make('attributes')
                                ->label('Атрибуты')
                                ->editableKeys(false)
                                ->editableValues(false)
                                ->deletable(false)
                                ->addable(false)
                                ->formatStateUsing(function(ProductVariant $record) {
                                    return $record->attributes->mapWithKeys(function (ModelAttribute $attribute) {
                                        /** @var Humanizer $attributeHumanizer */
                                        $attributeHumanizer = app(Humanizer::class);
                                        return [$attribute->attribute->getTranslatedField('title') => $attributeHumanizer->humanize($attribute)];
                                    });
                                })
                        ]),
                    ])
                    ->columnSpan(['lg' => 5]),
                Forms\Components\Group::make()
                    ->schema([
                        PublicStatusSection::make(),
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
                PublicStatusColumn::make()
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
                    ChangePublicStatusBulkAction::make()
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
            'index' => \App\Filament\Modules\Shop\Resources\ProductVariantResource\Pages\ListProductVariants::route('/'),
            'create' => \App\Filament\Modules\Shop\Resources\ProductVariantResource\Pages\CreateProductVariant::route('/create'),
            'edit' => \App\Filament\Modules\Shop\Resources\ProductVariantResource\Pages\EditProductVariant::route('/{record}/edit'),
        ];
    }
}
