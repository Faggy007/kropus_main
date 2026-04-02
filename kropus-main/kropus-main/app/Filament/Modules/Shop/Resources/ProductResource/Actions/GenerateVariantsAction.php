<?php

namespace App\Filament\Modules\Shop\Resources\ProductResource\Actions;

use Filament\Actions\Action;
use Modules\Shop\Models\Product;
use Modules\Shop\Services\ProductVariantGenerator\Generator;

class GenerateVariantsAction extends Action
{
    public static function make(?string $name = null): static
    {
        return parent::make($name)
            ->label('Сгенерировать вариации товара')
            ->action(function (Product $product) {
                /** @var Generator $generator */
                $generator = app(Generator::class);
                $generator->generate($product);
            });
    }
}
