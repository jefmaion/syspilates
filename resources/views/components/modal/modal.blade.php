@props(['size' => null])
<div wire:ignore.self {{ $attributes->merge(['class' => 'modal fade']) }}   tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog {{ $size ?? '' }} modal-dialog-centered" role="document">
        <div class="modal-content border-top border-top-3 rounded-top border-top-green">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            {{  $slot }}
        </div>
    </div>
</div>
