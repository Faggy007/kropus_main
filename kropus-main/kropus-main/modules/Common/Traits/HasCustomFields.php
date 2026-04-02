<?php

namespace Modules\Common\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Support\Facades\Storage;
use Modules\Common\Models\CustomFields;

/**
 * @mixin Model
 * @property CustomFields $customFields
 */
trait HasCustomFields
{
    public function customFields(): MorphOne
    {
        return $this->morphOne(CustomFields::class, 'model');
    }

    public function getCustomField(string $key, mixed $default = null): mixed
    {
        return $this->customFields->fields[$key] ?? $default;
    }

    public function getTranslatedCustomField(string $key, mixed $default = null, string $locale = null): mixed
    {
        $locale = $locale ?? app()->getLocale();
        $field = $this->getCustomField($key, []);
        return $field[$locale] ?? $default;
    }

    public function getCustomFieldFilePath(string $key, mixed $default = null): mixed
    {
        $path = $this->getCustomField($key, $default);
        if ($path) {
            return Storage::disk('public')->path($path);
        }
        return $path;
    }
}
