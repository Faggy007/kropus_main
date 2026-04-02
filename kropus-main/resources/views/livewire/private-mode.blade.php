<div @class(['fixed bottom-0 left-0 right-0 z-[100]', 'hidden' => !session('private_mode')])>
    @session('private_mode')
        <div class="bg-blue-400 text-white text-lg py-2 text-center flex items-center justify-center">
            Приватный режим просмотра
            <svg wire:click="exit" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2 cursor-pointer" fill="none" viewBox="0 0 24 24" stroke="currentColor" wire:click="$emit('closePrivateMode')">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </div>
    @endsession
</div>
