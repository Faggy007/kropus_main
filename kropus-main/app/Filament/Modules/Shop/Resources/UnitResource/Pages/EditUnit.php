<?php

namespace App\Filament\Modules\Shop\Resources\UnitResource\Pages;

use App\Filament\Modules\Shop\Resources\UnitResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Contracts\Support\Htmlable;

class EditUnit extends EditRecord
{
    protected static string $resource = UnitResource::class;

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
