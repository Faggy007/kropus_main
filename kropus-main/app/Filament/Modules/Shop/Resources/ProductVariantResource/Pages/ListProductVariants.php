<?php

namespace App\Filament\Modules\Shop\Resources\ProductVariantResource\Pages;

use App\Filament\Modules\Shop\Resources\ProductVariantResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListProductVariants extends ListRecords
{
    protected static string $resource = ProductVariantResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
