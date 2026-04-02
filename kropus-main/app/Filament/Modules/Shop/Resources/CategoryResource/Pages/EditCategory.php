<?php

namespace App\Filament\Modules\Shop\Resources\CategoryResource\Pages;

use App\Filament\Modules\Shop\Resources\CategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Contracts\Support\Htmlable;

class EditCategory extends EditRecord
{
    protected static string $resource = CategoryResource::class;

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
