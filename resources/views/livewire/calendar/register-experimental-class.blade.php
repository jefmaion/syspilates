<div>
    <x-modal.modal class="blur" id="modal-register-experimental">
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
                        <x-form.select-class-status name="status" wire:model='status' />
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Evolução/Comentários</label>
                        <textarea class="form-control {{ ($errors->has('instructor_comments') ? ' is-invalid' : '') }}" rows="5" name="instructor_comments" wire:model="instructor_comments"></textarea>
                        @error('instructor_comments')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn  btn-outline-secondary" data-bs-dismiss="modal">
                        Fechar
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <x-page.spinner>
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
