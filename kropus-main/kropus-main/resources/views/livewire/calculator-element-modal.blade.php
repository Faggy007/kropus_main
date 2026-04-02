<div class="p-[1rem] lg:p-[2.5rem]">
    <h4 class="subtitle-3 mb-[1.25rem] lg:mb-[2.5rem]">
        @if($mode == 'create')
            Добавление нового элемента
        @elseif($mode === 'update')
            Редактирование элемента
        @endif
    </h4>

    <div class="text-2 text-[#363636] mb-[1.25rem] lg:mb-[2.5rem]">
        Выберите тип элемента, который вы хотите добавить в калькулятор, и заполните необходимые поля в форме.
    </div>

    <div class="grid grid-cols-1 gap-4 lg:gap-5">
        <div class="form-control-wrap">
            <label class="form-control-label">Тип элемента</label>
            <select class="form-control-input" wire:model.live="data.type">
                <option value=""></option>
                @foreach($elementsOptions as $key => $option)
                    <option value="{{ $key }}">{{ $option }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-control-wrap">
            <label class="form-control-label">Грань</label>
            <select class="form-control-input" wire:model="data.face">
                <option value="top">Верхняя</option>
                <option value="bottom">Нижняя</option>
                <option value="left">Левая</option>
                <option value="right">Правая</option>
                <option value="front">Передняя</option>
                <option value="back">Задняя</option>
            </select>
        </div>
        <div class="grid gap-4 lg:gap-5 grid-cols-1 lg:grid-cols-4">
            <div class="form-control-wrap lg:col-span-2">
                <label class="form-control-label">Отступ слева <span class="text-gray-400">(мм)</span></label>
                <input class="form-control-input" wire:model="data.x" type="number">
            </div>
            <div class="form-control-wrap lg:col-span-2">
                <label class="form-control-label">Отступ снизу <span class="text-gray-400">(мм)</span></label>
                <input class="form-control-input" wire:model="data.y" type="number">
            </div>
            @if($data['type'] === 'hole')
                <div class="form-control-wrap lg:col-span-4">
                    <label class="form-control-label">Диаметр <span class="text-gray-400">(мм)</span></label>
                    <input class="form-control-input" wire:model="data.diameter" type="number">
                </div>
            @endif
        </div>
        <button wire:click="save" class="btn btn-primary w-full mt-4">
            @if($mode == 'create')
                Добавить элемент
            @elseif($mode === 'update')
                Сохранить изменения
            @endif
        </button>
    </div>
</div>
