@props(['text' => 'Processando...', 'target' => null])
<div>
    <span wire:loading.remove wire:target='{{ $target }}'>{{ $slot }}</span>
    <span wire:loading wire:target='{{ $target }}'>
        <span class="spinner-border spinner-border-sm"></span>
        {{ $text }}
    </span>
</div>