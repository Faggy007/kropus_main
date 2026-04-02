<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static bool isMobile()
 */
class MobileDetect extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Detection\MobileDetect::class;
    }
}
