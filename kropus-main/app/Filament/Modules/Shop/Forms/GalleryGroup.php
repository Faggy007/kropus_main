<?php

namespace App\Filament\Modules\Shop\Forms;

use App\Filament\Forms\Components\FileUpload;
use Filament\Forms;

class GalleryGroup
{
    const OPTIONS = [
        'image' => 'Изображение',
        'video' => 'Видео',
        'iframe' => 'Iframe',
    ];

    public static function make(): Forms\Components\Group
    {
        return  Forms\Components\Group::make([
            Forms\Components\Repeater::make('items')
                ->relationship('items')
                ->collapsed()
                ->minItems(0)
                ->defaultItems(0)
                ->label('Элементы галереи')
                ->itemLabel(fn (array $state): ?string => self::OPTIONS[$state['type']] ?? 'Элемент галереи')
                ->schema([
                    Forms\Components\Select::make('type')
                        ->label('Тип')
                        ->options(self::OPTIONS)
                        ->required()
                        ->reactive(),
                    FileUpload::make('image')
                        ->label('Изображение')
                        ->image()
                        ->visible(fn (callable $get) => $get('type') === 'image')
                        ->required(fn (callable $get) => $get('type') === 'image'),
                    FileUpload::make('video')
                        ->label('Видео')
                        ->visible(fn (callable $get) => $get('type') === 'video')
                        ->required(fn (callable $get) => $get('type') === 'video'),
                    Forms\Components\TextInput::make('iframe')
                        ->label('Iframe')
                        ->visible(fn (callable $get) => $get('type') === 'iframe')
                        ->required(fn (callable $get) => $get('type') === 'iframe'),
                    FileUpload::make('preview_image')
                        ->label('Превью изображение')
                        ->image()
                        ->hint('Необязательно при типе "Изображение"')
                        ->visible(fn (callable $get) => $get('type') !== null)
                        ->required(fn (callable $get) => $get('type') !== 'image'),
                ])
                ->addActionLabel('Добавить элемент')
                ->collapsible()
                ->orderColumn('order')
        ])->relationship('gallery');
    }
}
