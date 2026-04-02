<?php

namespace App\Filament\Modules\Shop\Resources\ProductResource\Pages;

use App\Filament\Modules\Shop\Forms\InfoTabsGroup;
use App\Filament\Modules\Shop\Resources\ProductResource;
use Filament\Forms\Form;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Contracts\Support\Htmlable;

class EditProductInfoTabs extends EditRecord
{
    protected static string $resource = ProductResource::class;

    protected static ?string $navigationLabel = 'Информационные вкладки';

    public function getSubheading(): string|Htmlable|null
    {
        return $this->record->getTranslatedField('title');
    }

    public function form(Form $form): Form
    {
        return $form->schema([
            InfoTabsGroup::make()->columnSpanFull(),
        ]);
    }
}
