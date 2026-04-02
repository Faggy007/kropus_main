<?php

namespace App\Livewire;

use LivewireUI\Modal\ModalComponent;

class ContactFormModal extends ModalComponent
{
    public string $title = 'Оставить заявку';

    public ?string $description = 'Оставьте свои контактные данные, мы свяжемся с вами в ближайшее время.';

    public array $data = [];

    public static function modalMaxWidth(): string
    {
        return '2xl';
    }

    public function render()
    {
        return view('livewire.contact-form-modal');
    }
}
