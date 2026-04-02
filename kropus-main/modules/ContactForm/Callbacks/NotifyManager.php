<?php

namespace Modules\ContactForm\Callbacks;

use Denobraz\LaravelContactForm\Callbacks\QueueableContactFormCallback;
use Illuminate\Support\Facades\Notification;
use Modules\ContactForm\Notifications\ManagerContactForm;
use Modules\ContactForm\Settings\ContactFormSettings;

class NotifyManager extends QueueableContactFormCallback
{

    public function handle(): void
    {
        /** @var ContactFormSettings $settings */
        $settings = app(ContactFormSettings::class);
        $data = $this->contactForm->data;
        if ($this->contactForm->referer()) {
            $data['referer'] = $this->contactForm->referer();
        }
        foreach ($settings->notification_emails as $email) {
            $notification = new ManagerContactForm(
                'Новое обращения с сайта "' . config('app.name') . '"',
                $data
            );
            Notification::route('mail', $email)->notify($notification);
        }
    }
}
