<?php

namespace App\Filament\Modules\Shop\Resources\ModifierResource\Pages;

use App\Filament\Modules\Shop\Resources\ModifierResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Contracts\Support\Htmlable;

class EditModifier extends EditRecord
{
    protected static string $resource = ModifierResource::class;

    public function getSubheading(): string|Htmlable|null
    {
        return $this->record->getTranslatedField('title');
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
