<?php

namespace App\Livewire;

use LivewireUI\Modal\ModalComponent;
use Modules\Calculator\Data\Element;
use Modules\Calculator\Data\Elements\As207;
use Modules\Calculator\Data\Elements\As208;
use Modules\Calculator\Data\Elements\Aux;
use Modules\Calculator\Data\Elements\Db15;
use Modules\Calculator\Data\Elements\Db25;
use Modules\Calculator\Data\Elements\Db9;
use Modules\Calculator\Data\Elements\Hdmi;
use Modules\Calculator\Data\Elements\Hole;
use Modules\Calculator\Data\Elements\Rj45;
use Modules\Calculator\Data\Elements\Rmdt2;
use Modules\Calculator\Data\Elements\UsbA;
use Modules\Calculator\Data\Elements\UsbC;

class CalculatorElementModal extends ModalComponent
{
    public string $mode = 'create';

    public array $elements = [
        'hole' => Hole::class,
        'hdmi' => Hdmi::class,
        'usb_a' => UsbA::class,
        'usb_c' => UsbC::class,
        'aux' => Aux::class,
        'db9' => Db9::class,
        'db15' => Db15::class,
        'db25' => Db25::class,
        'rj45' => Rj45::class,
        '2rmdt' => Rmdt2::class,
        'as207' => As207::class,
        'as208' => As208::class,
    ];

    public string $elementKey = '';

    public array $data = [];

    public function mount()
    {
        if (empty($this->data)) {
            $this->data = [
                'type' => '',
                'face' => 'top',
            ];
        }
    }

    public static function modalMaxWidth(): string
    {
        return '2xl';
    }

    public function render()
    {
        return view('livewire.calculator-element-modal', [
            'elementsOptions' => $this->elementsOptions(),
        ]);
    }

    public function elementsOptions(): array
    {
        $options = [];
        /**
         * @var string $key
         * @var Element $element
         */
        foreach ($this->elements as $key => $element) {
            $options[$key] = $element::label();
        }
        return $options;
    }

    public function save()
    {
        if ($this->mode == 'create') {
            $this->dispatch('calculator-element-modal-save', [
                'data' => [
                    ...$this->data,
                    'label' => $this->elements[$this->data['type']]::label()
                ],
            ]);
        } elseif ($this->mode == 'update') {
            $this->dispatch('calculator-element-modal-update', [
                'key' => $this->elementKey,
                'data' => [
                    ...$this->data,
                    'label' => $this->elements[$this->data['type']]::label()
                ]
            ]);
        }

        $this->closeModal();
    }
}
