<?php

namespace App\Filament\TipTap\Blocks;

use App\Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Radio;
use FilamentTiptapEditor\TiptapBlock;

class GalleryBlock extends TiptapBlock
{
    public string $preview = 'tiptap.blocks.gallery.preview';
    public string $rendered = 'tiptap.blocks.gallery.rendered';

    public ?string $label = 'Галерея';

    public function getFormSchema(): array
    {
        return [
            Radio::make('aspect_ratio')
                ->label('Соотношение сторон')
                ->options([
                    '1/1' => '1/1',
                    '16/9' => '16/9',
                    '4/3' => '4/3',
                ])
                ->default('1/1')
                ->required()
                ->columnSpanFull(),
            Radio::make('columns')
                ->label('Количество колонок')
                ->options([
                    2 => '2 колонки',
                    3 => '3 колонки',
                    4 => '4 колонки',
                ])
                ->default(3)
                ->required()
                ->columnSpanFull(),
            FileUpload::make('images')
                ->label('Изображения')
                ->multiple()
                ->image()
                ->required()
                ->reorderable()
                ->maxFiles(9)
                ->columnSpanFull(),
        ];
    }
}
