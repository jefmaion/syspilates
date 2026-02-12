<x-modal.modal class="blur" id="modal-edit-transaction" sizse="modal-lg">
    <form wire:submit="save">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title align-items-center" id="modalTitleId">
                    <x-icons.users /> Editar Lançamento
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">

                <div class="row">

                    <div class="col-4 mb-3">
                        <label class="form-label">Data</label>
                        <x-form.input-text type="date" wire:model='date' name="date" />
                    </div>

                    <div class="col-4 mb-3">
                        <label class="form-label">Tipo</label>
                        <x-form.select-transaction-type wire:model='type' name="type" />
                    </div>

                    <div class="col-4 mb-3">
                        <label class="form-label">Valor</label>
                        <x-form.input-currency wire:model='amount' name="amount" />
                    </div>

                    <div class="col-12 mb-3">
                        <label class="form-label">Descrição</label>
                        <x-form.input-text type="text" wire:model='description' name="description" />
                    </div>

                    <div class="col-4 mb-3">
                        <label class="form-label">Forma de Pagamento</label>
                        <x-form.select-payment-method wire:model='payment_method' name="payment_method" />
                    </div>

                    <div class="col-4 mb-3">
                        <label class="form-label">Categoria</label>
                        <x-form.select-category wire:model='category_id' name="category_id" />
                    </div>
                    {{--
                    <div class="col-4 mb-3">
                        <label class="form-label">Status</label>
                        <x-form.select wire:model='payed' name="payed">
                            <option value=""></option>
                            <option value="0">Aberto</option>
                            <option value="1">Pago</option>
                        </x-form.select>
                    </div> --}}

                    <div class="col-12 mb-3">
                        <label class="form-label">Aluno</label>
                        <x-form.select-student wire:model='student_id' name="student_id" />
                    </div>

                    <div class="col-12 mb-3">
                        <label class="form-label">Comentários</label>
                        <x-form.textarea wire:model='comments' name="comments" />
                    </div>

                    {{-- <div class="col-8 mb-3">
                        <label class="form-label">Repetir</label>
                        <x-form.select wire:model='repeat' name="repeat">
                            <option value=""></option>
                            <option value="weekly">Semanalmente</option>
                            <option value="biweekly">Quinzenal</option>
                            <option value="monthly">Mensalmente</option>
                        </x-form.select>
                    </div>

                    <div class="col-4 mb-3">
                        <label class="form-label">Vezes</label>
                        <x-form.input-text type="text" wire:model='repeat_times' name="repeat_times" />
                    </div> --}}


                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn  btn-outline-secondary" data-bs-dismiss="modal">
                    Fechar
                </button>

                <button type="submit" class="btn btn-primary">
                    <span wire:loading.remove>@if($transaction?->type == App\Enums\TransactionTypeEnum::DEBIT) Pagar
                        @else Receber @endif</span>
                    <span wire:loading>
                        <span class="spinner-border spinner-border-sm"></span>
                        Salvando...
                    </span>
                </button>
            </div>
        </div>
    </form>
</x-modal.modal>