<?php

namespace App\Filament\Tables\Columns;

use Filament\Tables\Columns\TextColumn;

class MultilingualTextColumn extends TextColumn
{
    public static function make(string $name): static
    {
        $locale = app()->getLocale();
        return parent::make($name.'.'.$locale);
    }
}
