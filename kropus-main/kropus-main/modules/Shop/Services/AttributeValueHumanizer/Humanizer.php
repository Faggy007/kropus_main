<?php

namespace Modules\Shop\Services\AttributeValueHumanizer;

use Modules\Shop\Models\AttributeType;
use Modules\Shop\Models\ModelAttribute;

class Humanizer
{
    public function humanize(
        ModelAttribute $attribute,
        bool $showUnit = true,
        ?string $locale = null,
    ): string
    {
        $value = match ($attribute->attribute->type) {
            AttributeType::TEXT => $attribute->getTranslatedField('text_value', '', $locale),
            AttributeType::NUMBER => (string) $attribute->numeric_value,
            AttributeType::OPTIONS => $attribute->option->getTranslatedField('title', '', $locale),
            default => 'Not supported type',
        };

        if ($showUnit && $attribute->attribute->unit) {
            $value .= ' ' . $attribute->attribute->getTranslatedField('short_title', '', $locale);
        }

        return $value;
    }
}
