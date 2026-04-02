<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class GeneralSettings extends Settings
{
    public ?string $email = null;

    public ?string $phone = null;

    public ?string $address = null;

    public ?string $vk_link = null;

    public ?string $tg_link = null;

    public ?string $max_link = null;

    public ?string $map_iframe = null;

    public ?string $legal_full_name = null;

    public ?string $inn = null;

    public ?string $ogrn = null;

    public static function group(): string
    {
        return 'general';
    }
}
