<?php

namespace App\Filament\Forms\Components\PublicStatus;

use Closure;
use Filament\Forms;
use Filament\Forms\Components\Group;

class PublicStatusGroup extends Group
{
    public static function make(array|Closure $schema = []): static
    {
        return parent::make([
            PublicStatusInput::make(),
        ])->relationship('publicStatus');
    }
}
