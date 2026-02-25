<div>
    <x-modal.modal class="blur" id="modal-form-plan">
        <form wire:submit="save">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title align-items-center" id="modalTitleId">
                        <x-icons.users /> {{ $title }}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nome</label>
                        <x-form.input-text type="text" wire:model='form.name' name="form.name" />
                    </div>

                    <div class="row">
                        <div class="col-4 mb-3">
                            <label class="form-label">Duração (em Dias)</label>
                            <x-form.input-text type="text" wire:model='form.duration' name="form.duration" />
                        </div>

                        <div class="col-4 mb-3">
                            <label class="form-label">Aulas por Semana</label>
                            <x-form.input-text type="text" wire:model='form.classes_per_week'
                                name="form.classes_per_week" />
                        </div>

                        <div class="col-4 mb-3">
                            <label class="form-label">Valor do Plano</label>
                            <x-form.input-currency type="text" wire:model='form.value' name="form.value" />
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
</div>