<?php

namespace Modules\Bitrix24\Settings;

use Spatie\LaravelSettings\Settings;

class Bitrix24Settings extends Settings
{
    public ?string $lead_add_endpoint = null;

    public static function group(): string
    {
        return 'bitrix_24';
    }
}
