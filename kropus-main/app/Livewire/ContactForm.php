<?php

namespace App\Livewire;

use Denobraz\LaravelContactForm\ContactFormData;
use Denobraz\LaravelContactForm\ContactFormService;
use Illuminate\Support\Arr;
use Livewire\Attributes\Locked;
use Livewire\Component;
use Throwable;

class ContactForm extends Component
{
    #[Locked]
    public string $type = 'default';

    #[Locked]
    public string $view = 'default';

    public array $data = [];

    public function submit(ContactFormService $service)
    {
        $this->validate(
            Arr::prependKeysWith(config("contact_form.types.{$this->type}.data", []), 'data.'),
            Arr::prependKeysWith(config("contact_form.types.{$this->type}.messages", []), 'data.'),
            Arr::prependKeysWith([
                'name' => __('contact_form::attribute.name'),
                'email' => __('contact_form::attribute.email'),
                'phone' => __('contact_form::attribute.phone'),
                'message' => __('contact_form::attribute.message'),
                'email_or_phone' => __('contact_form::attribute.email_or_phone'),
            ], 'data.'),
        );

        $this->data['accept_text'] = __('contact_form::messages.accept_text');

        $data = new ContactFormData(
            $this->type,
            $this->data,
            request()->cookies->all(),
            [
                'ip' => request()->ip(),
                'user_agent' => request()->userAgent(),
                'referer' => request()->headers->get('referer'),
                'user_id' => auth()->user()?->id,
            ],
        );

        try {
            $service->handle($data);
            $this->data = [];
            session()->flash('success', __('contact_form::messages.success'));
        } catch (Throwable $e) {
            report($e);
            session()->flash('success', __('contact_form::messages.error'));
        }
    }

    public function render()
    {
        return view('livewire.contact-form.' . $this->view);
    }
}
