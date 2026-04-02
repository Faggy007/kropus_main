<?php

namespace Modules\Shop\Services\ProductVariantGenerator;

use Modules\Shop\Models\ModelAttribute;
use Modules\Shop\Models\ModelModifier;
use Modules\Shop\Models\ModelModifierOption;
use Modules\Shop\Models\ModifierOption;
use Modules\Shop\Models\Product;
use Modules\Shop\Models\ProductVariant;
use Modules\Shop\Services\ProductContentProcessor\Processor as ProductContentProcessor;

class Generator
{
    public function __construct(
        private SlugGenerator $slugGenerator,
        private TitleGenerator $titleGenerator,
        private ProductContentProcessor $contentProcessor,
    )
    {
    }

    public function generate(Product $product): void
    {
        // Генерирует декартово множество по модификаторам продукта
        $potentialVariants = collect([$product])->crossJoin(...$product->modifiers->map(function (ModelModifier $model) {
            return $model->modifier->options;
        }));

        foreach ($potentialVariants as $potentialVariant) {
            $options = collect($potentialVariant)->skip(1)->all();
            $this->findOrCreateProduct($product, $options);
        }
    }

    /**
     * @param Product $product
     * @param ModifierOption[] $options
x     */
    private function findOrCreateProduct(Product $product, array $options): void
    {
        $slug = $this->slugGenerator->generate($product, $options);

        $productVariant = ProductVariant::query()->updateOrCreate(
            [
                'slug' => $slug,
                'product_id' => $product->id,
            ],
            [
                'title' => $product->title,
                'description' => $product->description,
            ]
        );

        $modelModifierOptions = collect($options)
            ->map(fn(ModifierOption $option) => new ModelModifierOption(['option_id' => $option->id]))
            ->all();

        $productVariant->modifierOptions()->delete();

        $productVariant->modifierOptions()->saveMany($modelModifierOptions);

        $optionsAttributeModels = collect($options)
                ->map(fn(ModifierOption $option) => $option->attributes)
                ->flatten()
                ->unique('attribute_id')
                ->map(fn(ModelAttribute $attribute) => $attribute->replicate());

        $productAttributeModels = $product->attributes->map(fn(ModelAttribute $attribute) => $attribute->replicate());

        $attributeModels = $optionsAttributeModels->merge($productAttributeModels)->all();

        $productVariant->attributes()->delete();

        $productVariant->attributes()->saveMany($attributeModels);

        $locales = array_keys($product->title ?? []);

        $productVariant->title = array_combine($locales, array_map(fn($locale) => $this->titleGenerator->generate($product, $options, $locale), $locales));
        $productVariant->description = array_combine($locales, array_map(fn($locale) => $this->contentProcessor->process($productVariant, $product->getTranslatedField('description', $locale)), $locales));

        $productVariant->save();
    }
}
