<?php

return [
    'save_contact_forms' => true,
    'save_cookies' => true,
    'save_ip' => true,
    'save_user_agent' => true,
    'save_referer' => true,
    'save_user_id' => true,

    'types' => [
        'default' => [
            'data' => [
                'subject' => 'string|nullable',
                'name' => 'string|required',
                'email' => 'string|required|email',
                'phone' => 'string|nullable',
                'message' => 'string|nullable',
            ],
            'messages' => [
                // If you want to override the default message for some field
                // 'name.required' => 'Name is required',
            ],
            'attributes' => [
                // If you want to override the default attribute name for some field
                // 'name' => 'Name',
            ],
            'callbacks' => [
                //Denobraz\LaravelContactForm\Callbacks\DummyContactFormCallback::class,
                \Modules\ContactForm\Callbacks\NotifyManager::class,
                \Modules\Bitrix24\ContactForm\Callbacks\ExportToBitrix24::class
            ]
        ],
        'default_inline' => [
            'data' => [
                'subject' => 'string|nullable',
                'name' => 'string|required',
                'email_or_phone' => ['required', new \Modules\Common\Rules\EmailOrPhoneRule()],
                'message' => 'string|nullable',
            ],
            'messages' => [],
            'attributes' => [],
            'callbacks' => [
                //Denobraz\LaravelContactForm\Callbacks\DummyContactFormCallback::class,
                \Modules\ContactForm\Callbacks\SaveEmailOrPhoneToConcreteField::class,
                \Modules\ContactForm\Callbacks\NotifyManager::class,
                \Modules\Bitrix24\ContactForm\Callbacks\ExportToBitrix24::class
            ]
        ]
    ]
];
