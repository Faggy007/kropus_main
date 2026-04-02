<?php

namespace App\Filament\Forms\Components\Seo;

use Closure;
use Filament\Forms\Components\Section;
use Illuminate\Contracts\Support\Htmlable;

class SeoSection extends Section
{
    public static function make(Htmlable|array|Closure|string|null $heading = null): static
    {
        return parent::make($heading ?? 'SEO')->schema([
            SeoGroup::make(),
        ]);
    }
}
