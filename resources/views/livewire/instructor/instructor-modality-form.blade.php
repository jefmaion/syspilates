<x-modal.modal class="blur" id="modal-form-instructor-modality" sisze="modal-lg">
    <form wire:submit="{{ ($edit) ? 'update' : 'add' }}">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title align-items-center" id="modalTitleId">
                    <x-icons.users /> @if($edit) Editar @else Adicionar @endif Modalidade
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col">
                        <div class="row ">
                            <div class="col-12 mb-3">
                                <label class="form-label required">Modalidade</label>
                                <x-form.select-modality wire:model='modality_id' />
                            </div>
                            <div class="col-12">
                                <div>
                                <label class="form-check form-check-inline">
                                  <input class="form-check-input" type="radio" name="radios" value="percent" wire:click='setComissionLabel()' wire:model.live='commission_type' checked="">
                                  <span class="form-check-label">Comissão em Percentual (%)</span>
                                </label>
                                <label class="form-check form-check-inline">
                                  <input class="form-check-input" type="radio" name="radios" value="fixed" wire:click='setComissionLabel()' wire:model.live='commission_type'>
                                  <span class="form-check-label">Comissão em valor fixo</span>
                                </label>
                              </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label">{{ $label }}</label>
                                <x-form.input-text wire:model="commission_value" />
                            </div>

                            <div class="col-md-12">
                                <div>
                                    <label class="form-check">
                                        <input class="form-check-input" type="checkbox"
                                            wire:model='calculate_on_justified_absence' value="1">
                                        <span class="form-check-label">Calcular comissão na falta justificada</span>
                                    </label>

                                </div>
                            </div>
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