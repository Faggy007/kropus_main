<?php

namespace Modules\Shop\Data\Decorators;

use Modules\Common\Services\UrlService\UrlService;
use Modules\Shop\Data\Product\Attribute;
use Modules\Shop\Data\Product\GalleryItem;
use Modules\Shop\Data\Product\InfoTab;
use Modules\Shop\Data\Product\Modifier;
use Modules\Shop\Data\Product\ModifierGroup;
use Modules\Shop\Data\Product\ProductFull as ProductView;
use Modules\Shop\Models\ModelAttribute;
use Modules\Shop\Models\ModelModifier;
use Modules\Shop\Models\ModelModifierOption;
use Modules\Shop\Models\ModifierOption;
use Modules\Shop\Models\ProductVariant;
use Modules\Shop\Models\GalleryItem as GalleryItemModel;
use Modules\Shop\Models\InfoTab as InfoTabModel;

use Modules\Shop\Services\AttributeValueHumanizer\Humanizer as AttributeHumanizer;
use Modules\Shop\Services\ProductContentProcessor\Processor as ContentProcessor;
use Modules\Shop\Services\ProductVariantSearcher\Searcher as VariantSearcher;

class ProductFullDecorator
{
    public function __construct(
        private UrlService                $urlService,
        private ProductAttributeDecorator $attributeDecorator,
        private ContentProcessor          $contentProcessor,
        private VariantSearcher           $variantSearcher,
    )
    {
    }

    public function decorate(ProductVariant $variant): ProductView
    {
        $image = $variant->image ?? $variant->product->image;
        $slug = $variant->slug;
        $url = $this->urlService->entity($variant);
        $title = $variant->getTranslatedField('title');
        $description = $variant->getTranslatedField('description');
        $attributes = $variant->attributes->map(fn(ModelAttribute $model) => $this->attributeDecorator->decorate($model))->all();

        $variantOptions = $variant->modifierOptions->map(fn(ModelModifierOption $modifierOption) => $modifierOption->option);

        $modifierGroups = $variant->product->modifiers->map(function (ModelModifier $modifier) use ($variant, $variantOptions) {
            $options = $modifier->modifier->options->map(function (ModifierOption $option) use ($variant, $variantOptions) {
                $variantOptionsWithoutCurrentGroupOption = $variantOptions->filter(fn(ModifierOption $o) => $o->modifier->id !== $option->modifier->id)->all();
                $currentVariant = $this->variantSearcher->search($variant->product, [$option, ...$variantOptionsWithoutCurrentGroupOption]);
                return Modifier::from([
                    'title' => $option->getTranslatedField('title'),
                    'url' => $currentVariant ? $this->urlService->entity($currentVariant) : '',
                    'isActive' => $variant->modifierOptions->pluck('option_id')->contains($option->id),
                ]);
            })->all();

            return ModifierGroup::from([
                'title' => $modifier->modifier->getTranslatedField('title'),
                'modifiers' => $options,
            ]);
        });

        $modifierGroups = $modifierGroups->all();

        $galleryItems = $variant->product->gallery?->items->map(function (GalleryItemModel $model) {
            return GalleryItem::fromModel($model);
        })->all() ?? [];

        $infoTabs = $variant->product->infoTabs->map(function (InfoTabModel $model) use ($variant) {
            return InfoTab::from([
                'slug' => $model->slug,
                'title' => $model->getTranslatedField('title'),
                'content' => $this->contentProcessor->process($variant, $model->getTranslatedField('content')),
            ]);
        })->all();

        return ProductView::from([
            'slug' => $slug,
            'url' => $url,
            'image' => $image,
            'title' => $title,
            'description' => $description,
            'attributes' => $attributes,
            'modifierGroups' => $modifierGroups,
            'galleryItems' => $galleryItems,
            'infoTabs' => $infoTabs,
        ]);
    }
}
