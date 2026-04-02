<?php

namespace App\Filament\Modules\ContactForm;

use Denobraz\LaravelContactForm\Models\ContactForm;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ContactFormResource extends Resource
{
    protected static ?string $model = ContactForm::class;

    protected static ?string $navigationLabel = 'Заявки';

    protected static ?string $pluralModelLabel = 'Заявки';

    protected static ?string $modelLabel = 'Заявка';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make('Основная информация')->schema([
                            Forms\Components\KeyValue::make('data')->label('Поля формы'),
                            Forms\Components\KeyValue::make('meta')->label('Дополнительная информация'),
                            Forms\Components\KeyValue::make('cookies')->label('Куки файлы'),
                        ]),
                    ])
                    ->columnSpan(['lg' => 5]),
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make()->schema([
                            Forms\Components\DateTimePicker::make('created_at')
                                ->label('Дата отправки'),
                        ])
                    ])
                    ->columnSpan(['lg' => 3]),
            ])->columns(8);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Дата')
                    ->dateTime('d.m.Y H:i'),
                Tables\Columns\TextColumn::make('type')
                    ->getStateUsing(fn(ContactForm $record) => str($record->type)->title())
                    ->label('Тип'),
                Tables\Columns\TextColumn::make('name')
                    ->getStateUsing(fn(ContactForm $record) => $record->data('name'))
                    ->label('Имя'),
                Tables\Columns\TextColumn::make('email')
                    ->getStateUsing(fn(ContactForm $record) => $record->data('email'))
                    ->label('Email'),
                Tables\Columns\TextColumn::make('phone')
                    ->getStateUsing(fn(ContactForm $record) => $record->data('phone'))
                    ->label('Телефон'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
            ])->defaultSort('created_at', 'desc');
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
            'index' => \App\Filament\Modules\ContactForm\ContactFormResource\Pages\ListContactForms::route('/'),
            'view' => \App\Filament\Modules\ContactForm\ContactFormResource\Pages\ViewContactForm::route('/{record}'),
        ];
    }
}
