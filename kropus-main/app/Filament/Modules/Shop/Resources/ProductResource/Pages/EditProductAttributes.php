<?php

namespace App\Filament\Modules\Shop\Resources\ProductResource\Pages;

use App\Filament\Modules\Shop\Forms\ModelAttributesRepeater;
use App\Filament\Modules\Shop\Resources\ProductResource;
use Filament\Forms\Form;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Contracts\Support\Htmlable;

class EditProductAttributes extends EditRecord
{
    protected static string $resource = ProductResource::class;

    protected static ?string $navigationLabel = 'Атрибуты';

    public function getSubheading(): string|Htmlable|null
    {
        return $this->record->getTranslatedField('title');
    }

    public function form(Form $form): Form
    {
        return $form->schema([
            ModelAttributesRepeater::make()->columnSpanFull(),
        ]);
    }
}
