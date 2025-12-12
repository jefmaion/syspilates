<x-modal.modal class="blur" id="modal-form-student" size="modal-lg">
    <form wire:submit="{{ ($edit) ? 'update' : 'store' }}">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title align-items-center" id="modalTitleId">
                    <x-icons.users /> @if($edit) Editar @else Cadastrar @endif Aluno
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col">
                        @include('livewire.userform')
                        <div class="row ">
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Profissão</label>
                                <x-form.input-text name="form.profession" wire:model='form.profession' />
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Objetivo</label>
                                <textarea class="form-control" rows="3" name="form.objective"
                                    wire:model="form.objective"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn  btn-outline-secondary" data-bs-dismiss="modal">
                    Fechar
                </button>
                <button type="submit" class="btn btn-primary">
                    <span wire:loading.remove>Salvar</span>
                    <span wire:loading>
                        <span class="spinner-border spinner-border-sm"></span>
                        Salvando...
                    </span>
                </button>
            </div>
        </div>
    </form>

</x-modal.modal>