<div class="relative">
    @assets
    <script type="module" src="https://ajax.googleapis.com/ajax/libs/model-viewer/4.0.0/model-viewer.min.js"></script>
    @endassets

    <div class="flex flex-col lg:flex-row gap-5">
        <div id="constructor" class="lg:w-3/7">
            @if(!$isWorking)
                <x-alert type="danger" compact="true" closable="true" class="mb-4 lg:mb-5">
                    <strong>Внимание!</strong> Конструктор находится в стадии разработки и используется только в демонстрационных целях.
                </x-alert>
            @endif
            <div class="bg-[#F8F8F8] p-[1.5rem] lg:p-[1.875rem] rounded-[0.375rem] grid gap-4 lg:gap-5 grid-cols-1">
                <p class="text-2 font-semibold pb-4 lg:pb-5 border-b border-[#E2E6EC]">Размеры корпуса:</p>
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 lg:gap-5">
                    <div class="form-control-wrap">
                        <label class="form-control-label">Ширина <span class="text-gray-400">(мм)</span></label>
                        <input class="form-control-input" wire:model="data.width" type="number">
                    </div>
                    <div class="form-control-wrap">
                        <label class="form-control-label">Высота <span class="text-gray-400">(мм)</span></label>
                        <input class="form-control-input" wire:model="data.height" type="number">
                    </div>
                    <div class="form-control-wrap">
                        <label class="form-control-label">Глубина <span class="text-gray-400">(мм)</span></label>
                        <input class="form-control-input" wire:model="data.depth" type="number">
                    </div>
                </div>
            </div>
            @if($data['elements'])
                <div class="grid grid-cols-1 mt-4 lg:mt-5 gap-4 lg:gap-5">
                    @foreach($data['elements'] as $element)
                        <div class="flex items-center bg-[#F8F8F8] hover:bg-[#F1F1F1] active:bg-[#EBEBEB] rounded-[0.375rem] px-5 h-[3.125rem] lg:h-[4.25rem]" wire:key="{{ $loop->index }}">
                            <div>
                                <div class="text-2 font-semibold">Элемент {{ $loop->index + 1 }}</div>
                                <div class="">{{ $element['label'] }}</div>
                            </div>
                            <span class="ml-auto cursor-pointer hover:underline hover:text-primary" wire:click="$dispatch('openModal', { component: 'calculator-element-modal', arguments: {elementKey: {{$loop->index}}, data: @js($element), mode: 'update'} } )">Редактировать</span>
                            <span class="ml-4 text-red-800 text-[2rem] cursor-pointer" wire:click="removeElement({{$loop->index}})">&times;</span>
                        </div>
                    @endforeach
                </div>
            @endif
            <div class="mt-4 lg:mt-5">
                <button wire:click="$dispatch('openModal', { component: 'calculator-element-modal' })" class="btn btn-gray w-full mb-4 lg:mb-5">Добавить элемент</button>
                @if($isWorking)
                    <button wire:click="generate" class="btn btn-primary w-full">
                        <div wire:loading>
                            Загрузка...
                        </div>
                        <div wire:loading.remove>
                            Сгенерировать
                        </div>
                    </button>
                @else
                    <button wire:click="$dispatch('openModal', { component: 'contact-form-modal', arguments: {title: 'Генерация моделей на данный момент недоступна'} })" class="btn btn-primary w-full">
                        <div wire:loading>
                            Загрузка...
                        </div>
                        <div wire:loading.remove>
                            Сгенерировать
                        </div>
                    </button>
                @endif
            </div>
        </div>
        <div id="view" class="lg:w-4/7">
            <div id="view_inner" class="lg:sticky top-0">
                <div
                    id="calculator-viewer-panel"
                    class="relative border border-[#F8F8F8] bg-[#F8F8F8] rounded-[0.375rem] overflow-hidden"
                >
                    <div class="z-10 absolute top-0 left-0 w-full flex justify-end gap-3 p-[1.5rem] lg:p-[1.875rem]">
                        <button
                            type="button"
                            wire:click="$dispatch('openModal', { component: 'calculator-json-import-modal' })"
                            class="btn-square btn-dark-ghost"
                            title="Загрузить JSON"
                        >
                            {!! icon('upload')->class('w-[1.25rem] h-[1.25rem] lg:w-[1.5rem] lg:h-[1.5rem] text-white') !!}
                            <span class="sr-only">Загрузить JSON</span>
                        </button>
                        <button
                            type="button"
                            wire:click="downloadJson"
                            class="btn-square btn-dark-ghost"
                            title="Скачать JSON"
                        >
                            {!! icon('download')->class('w-[1.25rem] h-[1.25rem] lg:w-[1.5rem] lg:h-[1.5rem] text-white') !!}
                            <span class="sr-only">Скачать JSON</span>
                        </button>
                        <button
                            type="button"
                            class="btn-square btn-dark-ghost"
                            title="На весь экран"
                            data-calculator-fullscreen-btn
                            onclick="kropusCalculatorViewerAction(event, 'fullscreen')"
                        >
                            {!! icon('fullscreen')->class('w-[1.25rem] h-[1.25rem] lg:w-[1.5rem] lg:h-[1.5rem] text-white') !!}
                            <span class="sr-only">На весь экран</span>
                        </button>
                        <button
                            type="button"
                            class="btn-square btn-dark-ghost"
                            title="Сбросить позиционирование камеры"
                            onclick="kropusCalculatorViewerAction(event, 'reset-camera')"
                        >
                            {!! icon('view-reset')->class('w-[1.25rem] h-[1.25rem] lg:w-[1.5rem] lg:h-[1.5rem] text-white') !!}
                            <span class="sr-only">Сбросить позиционирование</span>
                        </button>
                    </div>
                    <model-viewer
                        style="height: 500px;"
                        class="w-full"
                        alt="3D model"
                        src="{{ $modelLink }}"
                        shadow-intensity="1"
                        camera-controls
                        touch-action="pan-y"
                    ></model-viewer>
                </div>
            </div>
        </div>
    </div>

    <div wire:loading wire:target="generate" class="opacity-20 bg-white absolute w-full h-full top-0 left-0 z-10 transition"></div>

    @script
        <script>
            $wire.on('calculator-edit-element-open', () => {
                $wire.$refresh();
                clipBody();
            });

            $wire.on('calculator-edit-element-close', () => {
                unclipBody();
            });

            (function initCalculatorViewerControls() {
                if (window.__kropusCalculatorViewerControls) {
                    return;
                }
                window.__kropusCalculatorViewerControls = true;

                if (!document.getElementById('kropus-calculator-viewer-panel-fs')) {
                    const style = document.createElement('style');
                    style.id = 'kropus-calculator-viewer-panel-fs';
                    style.textContent =
                        '#calculator-viewer-panel:fullscreen{display:flex;flex-direction:column;min-height:100vh;width:100%;border-radius:0}' +
                        '#calculator-viewer-panel:fullscreen model-viewer{flex:1;min-height:400px;height:auto!important}';
                    document.head.appendChild(style);
                }

                function syncFullscreenButtonTitle() {
                    const btn = document.querySelector('[data-calculator-fullscreen-btn]');
                    const panel = document.getElementById('calculator-viewer-panel');
                    if (!btn || !panel) {
                        return;
                    }
                    const inFs = document.fullscreenElement === panel;
                    btn.title = inFs ? 'Выйти из полноэкранного режима' : 'На весь экран';
                }

                window.kropusCalculatorViewerAction = function (e, action) {
                    e.preventDefault();
                    const panel = document.getElementById('calculator-viewer-panel');
                    const mv = panel?.querySelector('model-viewer');

                    if (action === 'reset-camera' && mv) {
                        mv.cameraTarget = 'auto auto auto';
                        mv.cameraOrbit = 'auto auto auto';
                        if (typeof mv.jumpCameraToGoal === 'function') {
                            mv.jumpCameraToGoal();
                        }
                        return;
                    }

                    if (action === 'fullscreen' && panel) {
                        if (document.fullscreenElement === panel) {
                            document.exitFullscreen().catch(() => {});
                        } else {
                            panel.requestFullscreen?.().catch(() => {});
                        }
                    }
                };

                document.addEventListener('fullscreenchange', syncFullscreenButtonTitle);
            })();
        </script>
    @endscript
</div>
