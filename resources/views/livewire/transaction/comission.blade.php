<x-modal.modal class="blur" id="modal-create-comission" size="modal-lg">
    <form wire:submit="save">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title align-items-center" id="modalTitleId">
                    <x-icons.users /> Calcular Comissão
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">

                <div class="row">

                    <div class="col-auto mb-3">
                        <label class="form-label">Instrutor</label>
                        <x-form.select-instructor wire:model='instructor_id' name="instructor_id" />
                    </div>

                    <div class="col-auto mb-3">
                        <label class="form-label">Data</label>
                        <x-form.input-text type="date" wire:model.live='start' name="start" />
                    </div>

                    <div class="col-auto mb-3">
                        <label class="form-label">Data</label>
                        <x-form.input-text type="date" wire:model.live='end' name="end" />
                    </div>

                    <div class="col-auto mb-3">
                        <a name="" id="" class="btn btn-primary" href="#" role="button" wire:click.prevent='calculate()'>Calcular</a>
                    </div>

                </div>
            </div>

            @if ($comissions)
                <div class="modal-bodsy">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Data</th>
                                <th>Valor Aula</th>
                                <th>Comissao</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($comissions as $comission)
                                <tr>
                                    <td scope="row">{{ $comission->datetime }}</td>
                                    <td>{{ currency($comission->class_value) }}</td>
                                    <th> {{ currency($comission->value) }} </th>
                                </tr>
                            @endforeach
                            <tr>
                                <th></th>
                                <th>Total a Receber</th>
                                <th>{{ currency($amount) }}</th>
                            </tr>

                        </tbody>
                    </table>
                </div>
            @endif

            <div class="modal-footer">
                <button type="button" class="btn  btn-outline-secondary" data-bs-dismiss="modal">
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
        </div>
    </form>
</x-modal.modal>
