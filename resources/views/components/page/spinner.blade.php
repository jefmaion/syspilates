@props(['text' => 'Salvando...'])
<div>
    <span wire:loading.remove>{{ $slot }}</span>
    <span wire:loading>
        <span class="spinner-border spinner-border-sm"></span>
        {{ $text }}
    </span>
</div>