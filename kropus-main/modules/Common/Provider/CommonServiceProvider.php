<?php

namespace Modules\Common\Provider;

use Illuminate\Support\ServiceProvider;
use Modules\Common\Services\ThumbnailService\OnDemandThumbnailService;
use Modules\Common\Services\ThumbnailService\ThumbnailService;

class CommonServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(ThumbnailService::class, OnDemandThumbnailService::class);
    }
}
