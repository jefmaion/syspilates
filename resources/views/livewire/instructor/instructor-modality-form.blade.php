<x-modal.modal class="blur" id="modal-form-instructor-modality" size="modal-sm">
    <form wire:submit="{{ ($edit) ? 'update' : 'add' }}">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title align-items-center" id="modalTitleId">
                    <x-icons.users /> @if($edit) Editar @else Adicionar @endif Modalidade
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row ">
                    <div class="col-12 mb-3">
                        <label class="form-label required">Modalidade</label>
                        <x-form.select-modality wire:model='form.modality_id' name="form.modality_id" />
                    </div>
                    <div class="col-12 mb-3">
                        <label class="form-label required">Tipo de Comissão</label>
                        <x-form.select wire:model='form.commission_type' name="form.commission_type">
                            <option value="percent">Percentual de aula (%)</option>
                            <option value="fixed">Valor fixo</option>
                        </x-form.select>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="form-label required">Valor</label>
                        <x-form.input-text wire:model="form.commission_value" name="form.commission_value" />
                    </div>

                    <div class="col-md-12">
                        <div>
                            <label class="form-check">
                                <input class="form-check-input" type="checkbox" wire:model='form.calculate_on_justified_absence' value="1">
                                <span class="form-check-label">Calcular comissão na falta justificada</span>
                            </label>

                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn  btn-outline-secondary" data-bs-dismiss="modal">
                    Fechar
                </button>
                <button type="submit" class="btn btn-primary">
                    <span wire:loading.remove wire:target="add,edit">Salvar</span>
                    <span wire:loading wire:target="add,edit">
                        <span class="spinner-border spinner-border-sm"></span>
                        Salvando...
                    </span>
                </button>
            </div>
        </div>
    </form>

</x-modal.modal>