<?php

namespace Modules\Common\Traits;

trait HasMultilingualFields
{
    public function getTranslatedField(string $field, mixed $default = null, string $locale = null): mixed
    {
        $locale = $locale ?? app()->getLocale();
        return $this->$field[$locale] ?? $default;
    }

    public function hasTranslatedField(string $field, string $locale = null): bool
    {
        $locale = $locale ?? app()->getLocale();
        return isset($this->$field[$locale]) && !empty($this->$field[$locale]);
    }
}
