<?php

namespace Modules\Shop\Data\Decorators;

use Modules\Shop\Data\Product\Attribute;
use Modules\Shop\Models\ModelAttribute;
use Modules\Shop\Services\AttributeValueHumanizer\Humanizer;

class ProductAttributeDecorator
{
    public function __construct(
        private Humanizer $attributeHumanizer
    )
    {
    }

    public function decorate(ModelAttribute $attribute): Attribute
    {
        $humanizedValue = $this->attributeHumanizer->humanize($attribute);

        return Attribute::from([
            'title' => $attribute->attribute->getTranslatedField('title'),
            'value' => $humanizedValue,
        ]);
    }
}
