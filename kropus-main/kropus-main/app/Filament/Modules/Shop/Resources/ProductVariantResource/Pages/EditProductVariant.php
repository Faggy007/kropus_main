<?php

namespace App\Filament\Modules\Shop\Resources\ProductVariantResource\Pages;

use App\Filament\Modules\Shop\Resources\ProductVariantResource;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Contracts\Support\Htmlable;

class EditProductVariant extends EditRecord
{
    protected static string $resource = ProductVariantResource::class;

    public function getSubheading(): string|Htmlable|null
    {
        return $this->record->getTranslatedField('title');
    }

    protected function getHeaderActions(): array
    {
        return [
            $this->getSaveFormAction()->submit(null)->action('save'),
        ];
    }
}
