<?php

namespace Modules\ContactForm\Settings;

use Spatie\LaravelSettings\Settings;

class ContactFormSettings extends Settings
{
    public array $notification_emails = [];

    public static function group(): string
    {
        return 'contact_form';
    }
}
