<?php

namespace App\Filament\TipTap\Blocks;

use Filament\Forms\Components\TextInput;
use FilamentTiptapEditor\TiptapBlock;

class ShortcodeBlock extends TiptapBlock
{
    public string $preview = 'tiptap.blocks.shortcode.preview';

    public string $rendered = 'tiptap.blocks.shortcode.rendered';

    public ?string $label = 'Шорткод';

    public function getFormSchema(): array
    {
        return [
            TextInput::make('content')->label('Шорткод'),
        ];
    }
}
