<?php

namespace App\Filament\TipTap\Blocks;

use App\Filament\Forms\Components\FileUpload;
use FilamentTiptapEditor\TiptapBlock;

class VideoBlock extends TiptapBlock
{
    public string $preview = 'tiptap.blocks.video.preview';
    public string $rendered = 'tiptap.blocks.video.rendered';

    public ?string $label = 'Видео';

    public function getFormSchema(): array
    {
        return [
            FileUpload::make('poster')
                ->label('Превью')
                ->image()
                ->columnSpanFull(),
            FileUpload::make('video')
                ->label('Видео')
                ->acceptedFileTypes(['video/mp4'])
                ->required()
                ->columnSpanFull(),
        ];
    }
}
