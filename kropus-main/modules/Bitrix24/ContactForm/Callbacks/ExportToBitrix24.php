<?php

namespace Modules\Bitrix24\ContactForm\Callbacks;

use Denobraz\LaravelContactForm\Callbacks\QueueableContactFormCallback;
use Illuminate\Support\Facades\Http;
use Modules\Bitrix24\Settings\Bitrix24Settings;

class ExportToBitrix24 extends QueueableContactFormCallback
{
    public function handle(): void
    {
        /** @var Bitrix24Settings $settings */
        $settings = app(Bitrix24Settings::class);

        if (empty($settings->lead_add_endpoint)) {
            return;
        }

        $fields = [
            'TITLE' => 'Новый лид с сайта',
            //'LAST_NAME' => 'Иванов',
        ];

        if ($this->contactForm->data('subject')) {
            $fields['SUBJECT'] = $this->contactForm->data('subject');
        }

        if ($this->contactForm->data('name')) {
            $fields['NAME'] = $this->contactForm->data('name');
        }

        $phone = $this->contactForm->data('phone');
        $email = $this->contactForm->data('email');
        $emailOrPhone = $this->contactForm->data('email_or_phone');
        if (empty($phone) && empty($email) && !empty($emailOrPhone)) {
            if (filter_var($emailOrPhone, FILTER_VALIDATE_EMAIL)) {
                $email = $emailOrPhone;
            } else {
                $phone = $emailOrPhone;
            }
        }

        if ($phone) {
            $fields['PHONE'] = [
                ['VALUE' => $phone, 'VALUE_TYPE' => 'WORK'],
            ];
        }

        if ($email) {
            $fields['EMAIL'] = [
                ['VALUE' => $email, 'VALUE_TYPE' => 'WORK'],
            ];
        }

        if ($this->contactForm->data('message')) {
            $fields['COMMENTS'] = $this->contactForm->data('message');
        }

        $response = Http::post($settings->lead_add_endpoint, [
            'fields' => $fields,
            'params' => [
                'REGISTER_SONET_EVENT' => 'Y',
            ],
        ]);

        $meta = $this->contactForm->meta;

        if ($response->successful()) {
            $meta['bitrix_lead_success'] = true;
        } else {
            $meta['bitrix_lead_success'] = false;
            $meta['bitrix_lead_error_response'] = $response->body();
            logger()->error('Ошибка создания лида в Битрикс24', ['response' => $response->body()]);
        }

        $meta['bitrix_lead_response'] = $response->body();

        $this->contactForm->meta = $meta;
        $this->contactForm->save();
    }
}
