<?php

namespace Modules\ContactForm\Providers;

use Carbon\Laravel\ServiceProvider;

class ContactFormServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadTranslationsFrom(__DIR__ . '/../lang', 'contact_form');
    }
}
