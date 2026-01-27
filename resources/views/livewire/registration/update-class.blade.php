<x-modal.modal class="blur" id="modal-update-class" size="modal-md">
    <div class="modal-status bg-primary"></div>
    <div class="modal-header">
        <h5 class="modal-title align-items-center" id="modalTitleId">
            Editar Aulas
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">

        <div class="row">
            <div class="col-6 mb-3">
                <label class="form-label required">Dia</label>
                <x-form.input-text type="date" name="date" wire:model="date" />
            </div>

            <div class="col-6 mb-3">
                <label class="form-label required">Horario</label>
                <x-form.select-time type="time" name="time" wire:model='time' />
            </div>

            <div class="col-12 mb-3">
                <label class="form-label">Professor</label>
                <x-form.select-instructor name="instructor_id" wire:model='instructor_id' />
            </div>

            <div class="col-12 mb-3">
                <label for="" class="form-label">Status</label>
                <x-form.select-class-status name="status" wire:model.live='status' />
            </div>

            @if($isScheduled)
                <div class="col-12 mb-3">
                    <label class="form-label">Evolução</label>
                    <textarea class="form-control {{ ($errors->has('evolution') ? ' is-invalid' : '') }}" rows="5" name="evolution" wire:model="evolution"></textarea>
                    @error('evolution')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            @endif

            {{-- @if(in_array($status, $makeupConditions))
            <div class="col-12 mb-3">
                <label class="form-check">
                    <input class="form-check-input" wire:model='canMakeup' type="checkbox" checked>
                    <span class="form-check-label">Permitir reposição</span>
                </label>
            </div>
            @endif --}}

        </div>
    </div>
    <div class="modal-footer bsorder-0 bg-tsransparent">
        <button type="button" class="btn btn-link link-secondary me-auto" data-bs-dismiss="modal">
            Fechar
        </button>

        <button type="button" class="btn btn-primary" wire:click='save()'>
            <span wire:loading.remove>Salvar</span>
            <span wire:loading>
                <span class="spinner-border spinner-border-sm"></span>
                Salvando...
            </span>
        </button>
    </div>
</x-modal.modal>
