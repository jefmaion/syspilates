<div>
    <x-modal.modal class="blur" id="modal-show-experimental" size="modal-lg">
    @if($class)
    <div class="modal-header">
        <h5 class="modal-title align-items-center" id="modalTitleId">
            <x-icons.calendar />Aula Experimental  - {{ ucfirst($class?->datetime->translatedFormat('l, d \d\e F \d\e Y - H:i\h\r\s')); }}
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>

    <div class="modal-body">
        <div class="d-flex aslign-items-center">
            <div class="flex-fill">
                <h3 class="font-weight-medium mb-2">
                    <strong>{{ $class->name }}</strong>
                </h3>
                <div class="text-secondary text-sm ">
                    <x-icons.modality /> {{ $class?->modality->name }} |
                    <x-icons.time /> {{ ($class) ? $class->datetime->format('H\h') : '' }} |
                    <x-icons.phone /> {{ $class->phone ?? null }} |
                    <x-icons.instructor />{{ $class->instructor->user->shortName ?? null }}
                </div>
            </div>
        </div>
    </div>

    <div class="modal-body">
        <div class="">
            <div><strong>Observações</strong></div>
            {{ $class->comments }}
        </div>
        @if(!empty($class->instructor_comments))
        <div class="mt-3">
            <strong>Comentários do Professor: </strong>{{ $class->instructor_comments }}
        </div>
        @endif
    </div>

    <div class="modal-footer border-0 bg-transparent">
        <button type="button" class="btn btn-link link-secondary me-auto" data-bs-dismiss="modal">
            Fechar
        </button>

        <button type="button" data-bs-dissmiss="modal" wire:click="edit()" class="btn btn-warning">
            <span class="d-flex align-items-center">
                <x-icons.edit class="me-2" /> <span>Editar</span>
            </span>
        </button>

        <button type="button" data-bs-dissmiss="modal" wire:click="removeClass()" class="btn btn-danger">
            <span class="d-flex align-items-center">
                <x-icons.trash class="me-2" /> <span>Excluir Aula</span>
            </span>
        </button>
    </div>
    @endif
</x-modal.modal>
<x-modal.modal-delete />
</div>
