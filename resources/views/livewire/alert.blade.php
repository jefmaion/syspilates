<div>
    @if($show)
    <div class="" x-data="{ show: true }" x-init="
        setTimeout(() => show = true, 10);
            setTimeout(() => {
                show = false;
                $wire.hide();   // ✅ chama método Livewire
            }, {{ $delay }})
        " x-show="show" x-transition.opacity.duration.500ms>

        <div class="alert alert-important alert-{{ $type ?? 'info' }} alert-dismissible" wire:transition role="alert">
            <div class="alert-icon">
                <x-dynamic-component component="{{ 'icons.'.$type }}" />

                </div>
            <div>
                <div class="alert-description">{{ $message }}</div>
            </div>
            <a class="btn-close" wire:click='hide()' 
                aria-label="close"></a>
        </div>

    </div>
    @endif
</div>