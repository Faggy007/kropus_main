<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Modules\Common\Services\Sitemap\SitemapService;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('app:sitemap', function (SitemapService $service) {
    $service->generate();
});

Schedule::command('app:sitemap')->daily()->at('00:00');

Schedule::command('app:calculator:clean-old-directories')->hourly();
