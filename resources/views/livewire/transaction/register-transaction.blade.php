<x-modal.modal class="blur" id="modal-register-transaction" size="modsal-lg">
    @if($transaction)
    <form wire:submit="save">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title align-items-center" id="modalTitleId">
                    <x-icons.users /> Registrar Pagamento
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
          
            <div class="modal-body">

                 <h2 class="mb-3"><strong>{{ $transaction->description }}</strong></h2>

                <div class="card mb-3">

                    <div class="card-body">
                        <x-table.table :search="false" class="mb-0 table-ssm">

                            <tbody>
                                @if($transaction->daysLate > 0)
                                <tr>
                                    <th>Valor Original</th>
                                    <td class="text-end">{{ currency($transaction->amount) }}</td>
                                </tr>

                                <tr>
                                    <th>Multa (2%)</th>
                                    <td class="text-end">{{ currency($transaction->fine) }}</td>
                                </tr>

                                <tr>
                                    <th>Juros (0,33 ao dia x {{ $transaction->daysLate }})</th>
                                    <td class="text-end">{{ currency($transaction->fee) }}</td>
                                </tr>
                                @endif
                                <tr>
                                    <th>Total a Pagar</th>
                                    <th class="text-end"><h3>{{ currency($transaction->amountWithFee) }}</h3></th>
                                </tr>
                            </tbody>
                        </x-table.table>
                    </div>
                </div>

                  <div class="mb-3">
                    <label class="form-label">Forma de Pagamento</label>
                    <x-form.select-payment-method wire:model='payment_method' name="payment_method" />
                </div>

                <div class="mb-3">
                    <label class="form-label">Data do Pagamento</label>
                    <x-form.input-text type="date" wire:model='paid_at' name="paid_at" />
                </div>

                <div class="mb-3">
                    <label class="form-label">Valor Pago</label>
                    <x-form.input-text type="text" wire:model='paid_amount' name="paid_amount" />
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn  btn-outline-secondary" data-bs-dismiss="modal">
                    Fechar
                </button>
                <button type="submit" class="btn btn-primary">
                    <span wire:loading.remove>Salvar</span>
                    <span wire:loading>
                        <span class="spinner-border spinner-border-sm"></span>
                        Salvando...
                    </span>
                </button>
            </div>
        </div>
    </form>
    @endif

</x-modal.modal>