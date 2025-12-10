<form wire:submit='save'>
            <div class="mb-3">
                <label class="form-label">Nome</label>
                <x-form.input-text type="text" wire:model='form.name' name="form.name" />
            </div>

            <div class="mb-3">
                <label class="form-label">Sigla</label>
                <x-form.input-text type="text" wire:model='form.acronym' name="form.acronym" />
            </div>
            
            <div class="text-start">
                <a href="{{ route('modality') }}" wire:navigate>Voltar</a>
                <button type="submit" class="btn btn-primary">Salvar</button>
            </div>
        </form>