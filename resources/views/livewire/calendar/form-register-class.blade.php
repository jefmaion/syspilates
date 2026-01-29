<div>
    <x-modal.modal class="blur" id="modal-register-class">
        <form wire:submit.prevent="submit">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title align-items-center" id="modalTitleId">
                        <x-icons.users /> Registrar Aula
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="" class="form-label">Status</label>
                        <x-form.select-class-status name="status" :except="$exceptOptions" wire:model.live='status' />
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Evolução/Comentários</label>
                        <textarea class="form-control {{ ($errors->has('evolution') ? ' is-invalid' : '') }}" rows="5"
                            name="evolution" wire:model="evolution"></textarea>
                        @error('evolution')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    @if(in_array($status, $makeupConditions))
                    <div class="mb-3">
                        <label class="form-check">
                            <input class="form-check-input" wire:model='canMakeup' type="checkbox" checked>
                            <span class="form-check-label">Permitir reposição</span>
                        </label>
                    </div>
                    @endif
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn  btn-outline-secondary" data-bs-dismiss="modal">
                        Fechar
                    </button>
                    <button type="button" class="btn btn-primary" wire:click='submit'>
                        <x-page.spinner target="submit">
                            <span class="d-flex align-items-center">
                                <x-icons.success class="me-2" /> <span>Salvar</span>
                            </span>
                        </x-page.spinner>
                    </button>
                </div>
            </div>
        </form>
    </x-modal.modal>
</div>
