<div class="row">
    <div class="col">
        @include('livewire.userform')
        <div class="row ">
            <div class="col-md-12 col-lg-6 mb-3">
                <label class="form-label">Profissão</label>
                <x-form.input-text name="form.profession" wire:model='form.profession' />
            </div>

            <div class="col-md-12 col-lg-6 mb-3">
                <label class="form-label">Documento</label>
                <x-form.input-text name="form.document" wire:model='form.document' />
            </div>
            <div class="col-md-12 mb-3">
                <label class="form-label">Comentários</label>
                <textarea class="form-control" rows="3" name="form.comments" wire:model="form.comments"></textarea>
            </div>
        </div>
    </div>
</div>