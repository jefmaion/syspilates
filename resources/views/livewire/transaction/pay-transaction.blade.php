<x-modal.modal class="blur" id="modal-pay-transaction" sizse="modal-lg">
    @if($transaction)
    <form wire:submit="save">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title align-items-center" id="modalTitleId">
                    <x-icons.users /> Pagar/Receber
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <x-page.badge class="mb-1" color="{{ $transaction->currentStatus->color }}">{{
                    $transaction->currentStatus->label }}
                </x-page.badge>
                <h3 class="mb-0">{{ $transaction->description }}</h3>
            </div>

            @if (isset($transaction) && $transaction->category_id == 1 && $transaction->daysLate > 0)
            <div class="modal-body">

                <div class="card ">
                    {{-- @dd($transaction) --}}

                    <div class="card-header p-2">
                        <div class="card-title">Juros e Multas</div>
                    </div>

                    <div class="">
                        <x-table.table :search="false" class="mb-0 tables-sm fs-5 ">
                            <tbody>
                                <tr>
                                    <td>Valor Original</td>
                                    <td class="text-end">R$ {{ currency($transaction->origin_amount) }}</td>
                                </tr>
                                <tr>
                                    <td>Multa (2%)</td>
                                    <td class="text-end">R$ {{ currency($transaction->fine) }}</td>
                                </tr>
                                <tr>
                                    <td>Juros (0,33 ao dia x {{ $transaction->daysLate }})</td>
                                    <td class="text-end">R$ {{ currency($transaction->fee) }}</td>
                                </tr>
                                <tr>
                                    <td>Total a Pagar</td>
                                    <th class="text-end">
                                        <h3>R$ {{ currency($transaction->amountWithFee) }}</h3>
                                    </th>
                                </tr>
                            </tbody>
                        </x-table.table>
                    </div>

                </div>

            </div>
            @endif

            <div class="modal-body">
                <div class="row">

                    <div class="col-6 mb-3">
                        <label class="form-label">Data</label>
                        <x-form.input-text type="date" wire:model='paid_at' name="paid_at" />
                    </div>


                    <div class="col-6 mb-3">
                        <label class="form-label">Valor</label>
                        <x-form.input-currency wire:model='amount' name="amount" />
                    </div>

                    <div class="col-12 mb-3">
                        <label class="form-label">Forma de Pagamento</label>
                        <x-form.select-payment-method wire:model='payment_method' name="payment_method" />
                    </div>

                    <div class="col-12 mb-3">
                        <label class="form-label">Comentários</label>
                        <x-form.textarea wire:model='comments' name="comments" />
                    </div>


                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-link link-secondary me-auto" data-bs-dismiss="modal">
                    Fechar
                </button>
                <button type="submit" class="btn btn-primary">
                    <x-page.spinner>
                        <span class="d-flex align-items-center">
                            <x-icons.success class="me-2" /> <span>Salvar</span>
                        </span>
                    </x-page.spinner>
                </button>
            </div>
        </div>
    </form>
    @endif
</x-modal.modal>