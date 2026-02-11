<x-modal.modal class="blur" id="modal-experimental" sise="modal-lg">

    <form wire:submit="save">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title align-items-center" id="modalTitleId">
                    <x-icons.calendar /> Agendar Aula Experimental
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">

                <div class="row">


                    <div class="col-4 mb-3">
                        <label class="form-label required">Dia</label>
                        <x-form.input-text type="date" name="date" wire:model="date" />
                    </div>

                    <div class="col-4 mb-3">
                        <label class="form-label required">Horario</label>
                        <x-form.select-time type="time" name="time" wire:model='time' />
                    </div>

                    <div class="col-4 mb-3">
                        <label class="form-label required">Telefone</label>
                        <x-form.input-text name="phone" wire:model="phone" />
                    </div>

                    <div class="col-12 mb-3">
                        <label class="form-label required">Nome</label>
                        <x-form.input-text name="name" wire:model="name" />
                    </div>

                    <div class="col-12 mb-3">
                        <label class="form-label">Professor</label>
                        <x-form.select-instructor name="instructor_id" wire:model='instructor_id' />
                    </div>



                    <div class="col-6 mb-3">
                        <label for="" class="form-label">Modalidade</label>
                        <x-form.select-modality name="modality_id" wire:model='modality_id' />
                    </div>



                    <div class="col-6 mb-3">
                        <label for="" class="form-label">Valor</label>
                        <x-form.input-currency name="value" wire:model='value' />

                    </div>

                    <div class="mb-3 col-12">
                        <label class="form-label">Comentários</label>
                        <textarea class="form-control {{ $errors->has('comments') ? ' is-invalid' : '' }}" rows="5"
                            name="comments" wire:model="comments"></textarea>
                    </div>
                </div>
            </div>

            <div class="modal-footer border-0 bg-transparent">
                <button type="button" class="btn btn-link link-secondary me-auto" data-bs-dismiss="modal">
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