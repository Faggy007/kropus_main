<?php

namespace Modules\ContactForm\Callbacks;

use Denobraz\LaravelContactForm\Callbacks\ContactFormCallback;
class SaveEmailOrPhoneToConcreteField extends ContactFormCallback
{
    public function handle(): void
    {
        $data = $this->contactForm->data;
        $isEmail = filter_var($data['email_or_phone'], FILTER_VALIDATE_EMAIL);
        if ($isEmail) {
            $data['email'] = $data['email_or_phone'];
        } else {
            $data['phone'] = $data['email_or_phone'];
        }
        $this->contactForm->data = $data;
        $this->contactForm->save();
    }
}
