<?php

namespace App\Filament\TipTap\Blocks;

use Filament\Forms\Components\Textarea;
use FilamentTiptapEditor\TiptapBlock;

class CustomHtmlBlock extends TiptapBlock
{
    public string $preview = 'tiptap.blocks.custom-html.preview';

    public string $rendered = 'tiptap.blocks.custom-html.rendered';

    public string $width = 'xl';

    public ?string $label = 'Сырой HTML';

    //public bool $slideOver = true;

    public function getFormSchema(): array
    {
        return [
            Textarea::make('content')->label('Контент'),
        ];
    }
}
