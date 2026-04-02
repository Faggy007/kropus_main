<div class="p-[1rem] lg:p-[2.5rem]">
    <h4 class="subtitle-3 mb-[1.25rem] lg:mb-[2.5rem]">Загрузка конфигурации из JSON</h4>

    <div class="text-2 text-[#363636] mb-[1.25rem] lg:mb-[2.5rem]">
        Вставьте текст из ранее сохранённого файла или выберите <span class="whitespace-nowrap">.json</span>-файл на диске.
    </div>

    <div class="grid grid-cols-1 gap-4 lg:gap-5">
        <div class="form-control-wrap">
            <label class="form-control-label" for="calculator-json-file">Файл</label>
            <input
                id="calculator-json-file"
                type="file"
                accept=".json,application/json"
                class="form-control-input"
                wire:model="jsonFile"
            >
            <div wire:loading wire:target="jsonFile" class="text-2 text-[#363636] mt-2">Чтение файла…</div>
            @error('jsonFile')
                <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-control-wrap">
            <label class="form-control-label" for="calculator-json-textarea">JSON</label>
            <textarea
                id="calculator-json-textarea"
                class="form-control-input min-h-[12rem] font-mono text-sm"
                wire:model="jsonInput"
                rows="12"
                spellcheck="false"
            ></textarea>
        </div>

        @if($errorMessage)
            <x-alert type="danger" compact="true" class="mb-0">
                {{ $errorMessage }}
            </x-alert>
        @endif

        <button type="button" wire:click="import" class="btn btn-primary w-full mt-2">
            <span wire:loading.remove wire:target="import">Применить</span>
            <span wire:loading wire:target="import">Применение…</span>
        </button>
    </div>
</div>
