<div>
    <x-modal.modal class="blur" id="modal-register-class" size="xl">
        @if($registration)
        <form wire:submit="save">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title align-items-center" id="modalTitleId">
                        <x-icons.users /> Registrar Aula
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <x-page.user-block  size="lg" :user="$registration->student->user ?? ''">
                            <div class="flex-fill">
                                <h2 class="font-weight-medium mb-0"> <strong>{{ $registration->student->user->shortName ?? '' }}</strong></h2>
                                <div class="text-secondary">
                                    {{ $registration->modality->name ?? '' }}
                                </div>
                            </div>
                    </x-page.user-block>
                    </div>


                    <div class="mb-3">
                        <label for="" class="form-label">Instrutor</label>
                        <x-form.select-instructor wire:model='instructor_id' />
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Status</label>
                        <x-form.select-class-status wire:model='status' />
                           
                    </div>

                    <div class="mb-3">
                         <label class="form-label">Evolução/Comentários</label>
                                    <textarea class="form-control" rows="3" name="evolution" wire:model="evolution"></textarea>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn  btn-outline-secondary" data-bs-dismiss="modal">
                        Fechar
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <x-page.spinner>Salvar</x-page.spinner>
                    </button>
                </div>
            </div>
        </form>
        @endif
    </x-modal.modal>
</div>