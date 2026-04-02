<?php

namespace Modules\Shop\Models;

enum AttributeType: string
{
    case TEXT = 'text';
    case NUMBER = 'number';
    case OPTIONS = 'options';

    public static function labels(): array
    {
        return [
            self::TEXT->value => 'Текст',
            self::NUMBER->value => 'Число',
            self::OPTIONS->value => 'Выбор из списка',
        ];
    }

    public function label(): string
    {
        return self::labels()[$this->value] ?? $this->value;
    }
}
