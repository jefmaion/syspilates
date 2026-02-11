<x-modal.modal class="blur" id="modal-register-transaction" size="modsal-lg">
    @if ($transaction)
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
                    @if ($transaction->daysLate > 0)
                    <div class="card-body">
                        <x-table.table :search="false" class="mb-0 table-ssm">

                            <tbody>

                                <tr>
                                    <th>Valor Original</th>
                                    <td class="text-end">R$ {{ currency($transaction->origin_amount) }}</td>
                                </tr>

                                <tr>
                                    <th>Multa (2%)</th>
                                    <td class="text-end">R$ {{ currency($transaction->fine) }}</td>
                                </tr>

                                <tr>
                                    <th>Juros (0,33 ao dia x {{ $transaction->daysLate }})</th>
                                    <td class="text-end">R$ {{ currency($transaction->fee) }}</td>
                                </tr>

                                <tr>
                                    <th>Total a Pagar</th>
                                    <th class="text-end">
                                        <h3>R$ {{ currency($transaction->amountWithFee) }}</h3>
                                    </th>
                                </tr>
                            </tbody>
                        </x-table.table>
                    </div>
                    @endif
                </div>

                <div class="row">
                    <div class="col-4 mb-3">
                        <label class="form-label">Data do Pagamento</label>
                        <x-form.input-text type="date" wire:model='paid_at' name="paid_at" />
                    </div>

                    <div class="col-3 mb-3">
                        <label class="form-label">Valor à pagar</label>
                        <x-form.input-currency wire:model='amount' name="amount" />
                    </div>

                    <div class="col-5 mb-3">
                        <label class="form-label">Forma de Pagamento</label>
                        <x-form.select-payment-method wire:model='payment_method' name="payment_method" />
                    </div>

                    <div class="col-12 mb-3">
                        <label class="form-label">Comentários</label>
                        <x-form.textarea rows="5" wire:model='comments' name="comments" />
                    </div>
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