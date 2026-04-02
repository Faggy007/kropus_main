<?php

namespace Modules\Calculator\Data\Elements;

class Hole extends BasicElement
{
    public int $diameter;

    public static function label(): string
    {
        return 'Круглое отверстие';
    }
}
