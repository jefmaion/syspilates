<div>
    <x-modal.modal class="blur" id="modal-register-class" size="xl">
        <form wire:submit="save">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title align-items-center" id="modalTitleId">
                        <x-icons.users /> Registrar Aula
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    @include('livewire.calendar.event-header')
                </div>

                <div class="modal-body">
                    
               
                    @if($this->action == 'absense')
                        {{-- <div class="mb-3">
                            <label for="" class="form-label">Instrutor</label>
                            <x-form.select-instructor wire:model='instructor_id' />
                        </div> --}}
                        <div class="mb-3">
                            <label for="" class="form-label">Status</label>
                            <x-form.select-class-status wire:model='status' />
                        </div>
                    @endif

                    <div class="mb-3">
                            <label class="form-label">Evolução/Comentários</label> <textarea class="form-control" rows="5" name="evolution" wire:model="evolution"></textarea>
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