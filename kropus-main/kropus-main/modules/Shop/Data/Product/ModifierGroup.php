<?php

namespace Modules\Shop\Data\Product;

use Spatie\LaravelData\Data;

class ModifierGroup extends Data
{
    public string $title;

    /** @var Modifier[] */
    public array $modifiers = [];
}
