<?php

namespace App\Livewire;

use Livewire\WithFileUploads;
use LivewireUI\Modal\ModalComponent;

class CalculatorJsonImportModal extends ModalComponent
{
    use WithFileUploads;

    public string $jsonInput = '';

    public string $errorMessage = '';

    public $jsonFile = null;

    public static function modalMaxWidth(): string
    {
        return '2xl';
    }

    public function updatedJsonFile(): void
    {
        $this->errorMessage = '';
        if ($this->jsonFile === null) {
            return;
        }

        $this->validate([
            'jsonFile' => ['required', 'file', 'max:2048'],
        ]);
        $path = $this->jsonFile->getRealPath();
        $contents = $path !== false ? file_get_contents($path) : false;
        if ($contents !== false) {
            $this->jsonInput = $contents;
        }
        $this->jsonFile = null;
    }

    public function import(): void
    {
        $this->errorMessage = '';

        $decoded = json_decode($this->jsonInput, true);
        if (json_last_error() !== JSON_ERROR_NONE || ! is_array($decoded)) {
            $this->errorMessage = 'Некорректный JSON.';

            return;
        }

        $data = array_merge([
            'width' => 500,
            'height' => 200,
            'depth' => 300,
            'elements' => [],
        ], $decoded);

        $data['elements'] = isset($data['elements']) && is_array($data['elements'])
            ? array_values($data['elements'])
            : [];

        $this->dispatch('calculator-json-import', [
            'data' => $data,
        ]);
        $this->reset(['jsonInput']);
        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.calculator-json-import-modal');
    }
}
