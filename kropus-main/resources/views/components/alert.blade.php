@props(['type' => 'info', 'closable' => false, 'compact' => false])
<div {{ $attributes->class([
    'alert',
    'alert-' . $type,
    $compact ? 'alert-compact' : '',
]) }} role="alert" x-data="{ open: true }" x-show="open">
    @if($closable)
        <button class="absolute right-[1rem] top-[1rem] text-[1.5rem] cursor-pointer" type="button" class="alert-close" data-dismiss="alert" aria-label="Close" @click="open = false">
            <span aria-hidden="true">&times;</span>
        </button>
    @endif
    {{ $slot }}
</div>
