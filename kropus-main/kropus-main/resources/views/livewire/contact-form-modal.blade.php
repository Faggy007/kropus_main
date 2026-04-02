<div class="p-[1rem] lg:p-[2.5rem]">
    <h4 class="subtitle-3 mb-[1.25rem] lg:mb-[2.5rem]">{{ $title }}</h4>

    @if($description)
        <div class="text-2 text-[#363636] mb-[1.25rem] lg:mb-[2.5rem]">{{ $description }}</div>
    @endif

    @livewire('contact-form', ['type' => 'default', 'view' => 'default', 'data' => $data])
</div>
