<x-modal.modal class="blur" id="modal-form-transaction" size="modal-lg">
    <form wire:submit="save">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title align-items-center" id="modalTitleId">
                    <x-icons.money /> @if(!$transaction) Adicionar @else Editar @endif Lançamento
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

                    <div class="col-6 mb-3">
                        <label class="form-label">Forma de Pagamento</label>
                        <x-form.select-payment-method wire:model='payment_method' name="payment_method" />
                    </div>

                    <div class="col-6 mb-3">
                        <label class="form-label">Categoria</label>
                        <x-form.select-category wire:model='category_id' name="category_id" />
                    </div>

                    {{-- <div class="col-4 mb-3">
                        <label class="form-label">Status</label>
                        <x-form.select wire:model='payed' name="payed">
                            <option value=""></option>
                            <option value="0">Aberto</option>
                            <option value="1">Pago</option>
                        </x-form.select>
                    </div> --}}



                    <div class="col-12 mb-3">
                        <label class="form-label">Comentários</label>
                        <x-form.textarea wire:model='comments' rows="3" name="comments" />
                    </div>

                    @if(!isset($transaction))

                    <div class="col-12">
                        <label class="form-check">
                            <input class="form-check-input" type="checkbox" wire:model='paid'>
                            <span class="form-check-label">Marcar como pago/recebido</span>
                        </label>
                    </div>

                    @endif


                </div>


            </div>

            <div class="modal-body">
                <div class="col-12 mb-3">
                    <label class="form-label">Aluno</label>
                    <x-form.select-student wire:model='student_id' name="student_id" />
                </div>

                @if(!isset($transaction))

                <div class="row">
                    <div class="col-8 mb-3">
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
                    </div>
                </div>
                @endif
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
</x-modal.modal>