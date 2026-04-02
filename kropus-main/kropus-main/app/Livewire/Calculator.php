<?php

namespace App\Livewire;

use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Component;
use Modules\Calculator\Data\Model;
use Modules\Calculator\Mappers\ArrayToModelDataMapper;
use Modules\Calculator\Services\ModelGenerator\Generator;
use Symfony\Component\HttpFoundation\StreamedResponse;

class Calculator extends Component
{
    public string $modelLink;

    public bool $isWorking = true;

    public array $data = [
        'width' => 500,
        'height' => 200,
        'depth' => 300,
        'elements' => [],
    ];

    private Generator $model3DGenerator;

    private ArrayToModelDataMapper $arrayToModelDataMapper;

    public function mount()
    {
        $this->modelLink = asset('3d/case.glb');
        // $this->generate();
    }

    public function boot(
        Generator $model3DGenerator,
        ArrayToModelDataMapper $arrayToModelDataMapper
    ) {
        $this->model3DGenerator = $model3DGenerator;
        $this->arrayToModelDataMapper = $arrayToModelDataMapper;
    }

    #[On('calculator-element-modal-save')]
    public function addElement(array $payload)
    {
        $this->data['elements'][] = $payload['data'];
    }

    #[On('calculator-element-modal-update')]
    public function updateElement(array $payload)
    {
        $this->data['elements'][$payload['key']] = $payload['data'];
    }

    #[On('calculator-json-import')]
    public function importFromJson(array $payload): void
    {
        $this->data = $payload['data'];
    }

    public function removeElement($key)
    {
        unset($this->data['elements'][$key]);
        $this->data['elements'] = array_values($this->data['elements']);
    }

    public function generate(): void
    {
        $generatedModel = $this->model3DGenerator->generate($this->mapToModel());
        $this->modelLink = $generatedModel->glbPath;
    }

    public function downloadJson(): StreamedResponse
    {
        $json = json_encode($this->data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

        return response()->streamDownload(
            static fn () => print $json,
            'calculator.json',
            [
                'Content-Type' => 'application/json; charset=UTF-8',
            ]
        );
    }

    private function mapToModel(): Model
    {
        return $this->arrayToModelDataMapper->map($this->data);
    }

    public function render(): View
    {
        return view('livewire.calculator');
    }
}
