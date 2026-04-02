<?php

namespace App\Filament\Forms\Components\PublicStatus;

use Closure;
use Filament\Forms\Components\Section;
use Illuminate\Contracts\Support\Htmlable;

class PublicStatusSection extends Section
{
    public static function make(Htmlable|array|Closure|string|null $heading = null): static
    {
        return parent::make($heading ?? 'Статус публикации')->schema([
            PublicStatusGroup::make(),
        ]);
    }
}
