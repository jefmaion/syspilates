<form wire:submit='save'>
    @include('livewire.userform')
    <h4><strong>Outras Informações</strong></h4>
    <div class="row ">
        <div class="col-md-12 mb-3">
            <label class="form-label">Profissão</label>
            <x-form.input-text name="form.profession" wire:model='form.profession' />
        </div>
        {{-- <div class="col-md-12 mb-3">
            <label class="form-label">Objetivo</label>
            <x-form.textarea name="form.objective" />
        </div> --}}
    </div>
    <button type="submit" class="btn btn-primary">
        Button
    </button>

</form>