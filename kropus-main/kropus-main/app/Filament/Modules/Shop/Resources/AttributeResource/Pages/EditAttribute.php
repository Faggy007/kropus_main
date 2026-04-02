<?php

namespace App\Filament\Modules\Shop\Resources\AttributeResource\Pages;

use App\Filament\Modules\Shop\Resources\AttributeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Contracts\Support\Htmlable;

class EditAttribute extends EditRecord
{
    protected static string $resource = AttributeResource::class;

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
