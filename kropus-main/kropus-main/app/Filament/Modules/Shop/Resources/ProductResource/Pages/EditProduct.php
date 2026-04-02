<?php

namespace App\Filament\Modules\Shop\Resources\ProductResource\Pages;

use App\Filament\Modules\Shop\Resources\ProductResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Contracts\Support\Htmlable;

class EditProduct extends EditRecord
{
    protected static string $resource = ProductResource::class;

    protected static ?string $navigationLabel = 'Товар';

    public function getSubheading(): string|Htmlable|null
    {
        return $this->record->getTranslatedField('title');
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            ProductResource\Actions\GenerateVariantsAction::make('generate-variants')
        ];
    }
}
