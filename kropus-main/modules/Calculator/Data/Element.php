<?php

namespace Modules\Calculator\Data;

use Spatie\LaravelData\Data;

abstract class Element extends Data
{
    public string $type;
    public string $face;

    public abstract static function label(): string;
}
