@props(['modal' => true])

<div>
    @if($modal == true)
    <x-modal.modal class="blur" id="modal-form-instructor" size="modal-lg">
        <form wire:submit="{{ ($edit) ? 'update' : 'store' }}">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title align-items-center" id="modalTitleId">
                        <x-icons.users /> @if($edit) Editar @else Cadastrar @endif Professor
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                @include('livewire.instructor.instructor-form-fields')
                <div class="modal-footer">
                    <button type="button" class="btn  btn-outline-secondary" data-bs-dismiss="modal">
                        Fechar
                    </button>
                    <button type="button" class="btn btn-primary" wire:click='{{ ($edit) ? ' update' : 'store' }}'>
                        <x-page.spinner target="{{ ($edit) ? 'update' : 'store' }}">
                            <x-icons.success /> Salvar
                        </x-page.spinner>
                    </button>
                </div>
            </div>
        </form>

    </x-modal.modal>
    @else
    <form wire:submit="{{ ($edit) ? 'update' : 'store' }}">
        @include('livewire.instructor.instructor-form-fields')
        <button type="submit" class="btn btn-primary">
            <span wire:loading.remove>Salvar</span>
            <span wire:loading wire:target="{{ ($edit) ? 'update' : 'store' }}">
                <span class="spinner-border spinner-border-sm"></span>
                Salvando...
            </span>
        </button>
    </form>
    @endif
</div>