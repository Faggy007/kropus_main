<?php

namespace App\Filament\Modules\Blog\Resources;

use App\Filament\Forms\Components\FileUpload;
use App\Filament\Forms\Components\MultilingualFieldWrap;
use App\Filament\Forms\Components\PublicStatus\PublicStatusSection;
use App\Filament\Forms\Components\Seo\SeoSection;
use App\Filament\Modules\Blog\Resources\PostResource\CustomFields\CustomFields;
use App\Filament\Resources\PostResource\Pages;
use App\Filament\Resources\PostResource\RelationManagers;
use App\Filament\Tables\Columns\MultilingualTextColumn;
use App\Filament\Tables\Columns\PublicStatusColumn;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Table;
use FilamentTiptapEditor\Enums\TiptapOutput;
use FilamentTiptapEditor\TiptapEditor;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Modules\Blog\Models\Post;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $slug = 'blog/posts';

    protected static ?string $navigationGroup = 'Блог';

    protected static ?string $navigationLabel = 'Посты';

    protected static ?string $pluralModelLabel = 'Посты';

    protected static ?string $modelLabel = 'Пост';

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
                            MultilingualFieldWrap::make(
                                TiptapEditor::make('content_schema')
                                    ->label('Контент')
                                    ->output(TiptapOutput::Json)
                            ),
                        ]),
                        SeoSection::make(),
                    ])
                    ->columnSpan(['lg' => 5]),
                Forms\Components\Group::make()
                    ->schema([
                        PublicStatusSection::make(),
                        Forms\Components\Section::make()->schema([
                            Forms\Components\DatePicker::make('published_at')
                                ->label('Дата публикации'),
                            Forms\Components\Select::make('category')
                                ->label('Категория')
                                ->getOptionLabelFromRecordUsing(fn($record) => $record->getTranslatedField('title'))
                                ->relationship('category', 'title'),
                            Forms\Components\TextInput::make('slug')
                                ->rules(['alpha_dash'])
                                ->required()
                                ->label('Слаг'),
                            MultilingualFieldWrap::make(
                                Forms\Components\Textarea::make('excerpt')
                                    ->label('Отрывок'),
                            ),
                            FileUpload::make('image')
                                ->label('Изображение')
                                ->image()
                        ])
                    ])
                    ->columnSpan(['lg' => 3]),
                CustomFields::make()->columnSpanFull()
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
                MultilingualTextColumn::make('category.title')
                    ->label('Категория'),
                PublicStatusColumn::make()
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ])
            ])
            ->reorderable('order')
            ->defaultSort('order');
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
            'index' => \App\Filament\Modules\Blog\Resources\PostResource\Pages\ListPosts::route('/'),
            'create' => \App\Filament\Modules\Blog\Resources\PostResource\Pages\CreatePost::route('/create'),
            'edit' => \App\Filament\Modules\Blog\Resources\PostResource\Pages\EditPost::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
