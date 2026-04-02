<?php

namespace App\Filament\Forms\Components;

use Filament\Forms\Components\Component;
use Filament\Forms\Components\Concerns\HasLabel;
use Filament\Forms\Components\Concerns\HasName;
use Filament\Forms\Components\Group;

class MultilingualFieldWrap extends Component
{
    public static function make(Component $component): Group
    {
        $locales = config('app.locales');

        return Group::make(array_map(function ($locale) use ($component, $locales) {
            $newComponent = clone $component;
            $localeName = config('app.locale_names')[$locale] ?? $locale;
            if (in_array(HasName::class, class_uses_recursive($newComponent::class))) {
                /** @var HasName $newComponent */
                $newName = $newComponent->getName().'.'.$locale;
                $newComponent->name($newName);
                $newComponent->statePath($newName);
            }

            if (
                in_array(HasLabel::class, class_uses_recursive($newComponent::class)) &&
                count($locales) > 1
            ) {
                /** @var HasLabel $newComponent */
                $newComponent->label($newComponent->getLabel().' "'.$localeName.'"');
            }

            return $newComponent;
        }, $locales));
    }
}
