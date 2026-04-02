<?php

namespace App\Providers;

use App\Filament\TipTap\Blocks\CustomHtmlBlock;
use App\Filament\TipTap\Blocks\GalleryBlock;
use App\Filament\TipTap\Blocks\ShortcodeBlock;
use App\Filament\TipTap\Blocks\VideoBlock;
use FilamentTiptapEditor\TiptapEditor;
use Illuminate\Support\ServiceProvider;

class TipTapServiceProvider extends ServiceProvider
{
    public function register()
    {
        TiptapEditor::configureUsing(function (TiptapEditor $component) {
            $component
                ->collapseBlocksPanel()
                ->blocks([
                    ShortcodeBlock::class,
                    CustomHtmlBlock::class,
                    GalleryBlock::class,
                    VideoBlock::class
                ]);
        });
    }
}
