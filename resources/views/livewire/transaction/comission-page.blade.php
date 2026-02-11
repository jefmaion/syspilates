<div>
    @section('title')
    Lançamentos
    @endsection
    <x-page.page-header>
        <h2 class="page-title">
            <x-icons.users />
            Comissões
        </h2>


    </x-page.page-header>

    <x-page.page-body>


        <div class="row">

            <div class="col-12">

                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-end">
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
                                <a name="" id="" class="btn btn-primary" href="#" role="button"
                                    wire:click.prevent='calculate()'>Calcular</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-bodsy">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Professor</th>
                                    <th>Qtde. Aulas</th>
                                    <th>Total</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($comissions)
                                @foreach ($comissions as $comission)
                                <tr>
                                    <td scope="row">{{ $comission->instructor->user->name }}</td>
                                    <td>{{ $comission->total_class }}</td>
                                    <td> R$ {{ currency($comission->total) }} </td>
                                    <td>
                                        <a
                                            wire:click.prevent="createComissionTransaction('{{$comission->instructor->id}}')">
                                            Pagar
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                                @else
                                <tr>
                                    <td colspan="3" class="text-center">Nenhum</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>


                    </div>

                </div>
            </div>



        </div>

        <x-modal.modal class="blur" id="modal-pay" size="modsal-lg">
            @if($instructor)
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title align-items-center" id="modalTitleId">
                        <x-icons.users /> Registrar Pagamento
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">

                    <h2 class="mb-3"><strong>Criar Ordem de Pagamento</strong></h2>

                    <div class="card mb-3">
                        <div class="card-body">
                            <p><strong>Instrutor: </strong>{{ $instructor->user->shortName }}</p>
                            <p><strong>Perído: </strong>{{ $start }} até {{ $end }}</p>
                            <p><strong>Valor: </strong>R$ {{ $amount }}</p>
                        </div>
                    </div>



                    <div class="row">
                        <div class="col-4 mb-3">
                            <label class="form-label">Data do Pagamento</label>
                            <x-form.input-text type="date" wire:model='date' name="date" />
                        </div>


                        <div class="col-8 mb-3">
                            <label class="form-label">Forma de Pagamento</label>
                            <x-form.select-payment-method wire:model='payment_method' name="payment_method" />
                        </div>

                        <div class="col-12 mb-3">
                            <label class="form-label">Categoria</label>
                            <x-form.select-category wire:model='category_id' name="category_id" />
                        </div>

                        <div class="col-12 mb-3">
                            <label class="form-label">Comentários</label>
                            <x-form.textarea rows="5" wire:model='comments' name="comments" />
                        </div>

                        <div class="col-12">
                            <label class="form-check">
                                <input class="form-check-input" type="checkbox" wire:model='payed'>
                                <span class="form-check-label">Marcar como pago</span>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn  btn-outline-secondary" data-bs-dismiss="modal">
                        Fechar
                    </button>
                    <button type="button" class="btn btn-primary" wire:click='generatePayment'>
                        <span wire:loading.remove>Gerar Pagamento</span>
                        <span wire:loading>
                            <span class="spinner-border spinner-border-sm"></span>
                            Salvando...
                        </span>
                    </button>
                </div>
            </div>
            @endif
        </x-modal.modal>


    </x-page.page-body>
</div>