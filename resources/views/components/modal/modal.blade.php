@props(['size' => null])
<div class="modal fade" {{ $attributes }} tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog {{ $size ?? '' }} modal-dialog-centered" role="document">
        <div class="modal-content">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            {{  $slot }}
        </div>
    </div>
</div>