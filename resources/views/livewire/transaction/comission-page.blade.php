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
                    <div class="card-body">
                        <div class="row align-items-end">
                            <div class="col mb-3">
                                <label class="form-label">Instrutor</label>
                                <x-form.select-instructor wire:model='instructor_id' name="instructor_id" />
                            </div>
                            <div class="col-2 mb-3">
                                <label class="form-label">Data</label>
                                <x-form.input-text type="date" wire:model='start' name="start" />
                            </div>
                            <div class="col-2 mb-3">
                                <label class="form-label">Data</label>
                                <x-form.input-text type="date" wire:model='end' name="end" />
                            </div>
                            <div class="col-auto mb-3">
                                <a name="" id="" class="btn btn-primary" href="#" role="button"
                                    wire:click.prevent='calculate'>Calcular</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">

                        <div class="row mb-3">
                            <div class="col">
                                @if($instructor)
                                <h2>Valores de {{ $instructor->user->shortName }} - {{ $payStart->format('d/m') }} à {{
                                    $payEnd->format('d/m') }}</h2>
                                @endif

                            </div>
                            <div class="col text-end">
                                @if(!$comissions->isEmpty())

                                <button type="button" class="btn btn-primary" wire:click='createComissionTransaction'>
                                    <x-icons.money />

                                    Gerar
                                    Pagamento
                                </button>

                                @endif
                            </div>
                        </div>

                        <x-table.table :search="false">
                            <thead>
                                <tr>
                                    <th>Modalidade</th>
                                    <th>Aluno</th>
                                    <th>Data</th>
                                    <th class="text-center">Tipo de Comissão</th>
                                    <th class="text-center">Valor da Aula</th>
                                    <th class="text-center">Valor Comissão</th>
                                    <th class="text-center">Valor a Receber</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($comissions as $comission)
                                <tr>
                                    <td>{{ $comission->class->modality->name }}</td>
                                    <td>

                                        <x-page.user-avatar size="xs" :user="$comission->class->student->user">
                                            <span class="small">
                                                {{ $comission->class->student->user->shortName }}
                                            </span>
                                        </x-page.user-avatar>

                                    </td>
                                    <td>{{ $comission->class->datetime?->format('d/m/y H\h') }}</td>
                                    <td class="text-center">
                                        {{ $comission->comission_type->label() }}

                                    </td>
                                    <td class="text-center">R$ {{ currency($comission->class_value) }}</td>

                                    <td class="text-center">
                                        @if($comission->comission_type == App\Enums\ComissionTypeEnum::PERCENT)
                                        {{ $comission->comission_value }}{{ $comission->comission_type->icon()
                                        }}
                                        @endif

                                        @if($comission->comission_type == App\Enums\ComissionTypeEnum::FIXED)
                                        {{ $comission->comission_type->icon() }} {{
                                        currency($comission->comission_value) }}
                                        @endif
                                    </td>
                                    <td class="text-center">R$ {{ currency($comission->value) }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="9" class="text-center">
                                        Nenhuma comissão encontrada para esse período.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                            @if(!$comissions->isEmpty())
                            <tfoot>
                                <tr>
                                    <th colspan="9" class="text-end">
                                        <h1>Total: R$ {{ currency($amount) }} </h1>
                                    </th>
                                </tr>
                            </tfoot>
                            @endif
                        </x-table.table>
                        <div class="mt-3">
                            {{ $comissions->links() }}
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <x-modal.modal class="blur" id="modal-pay" size="modsal-lg">
            @if($instructor)
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title align-items-center" id="modalTitleId">
                        <x-icons.users /> Gerar Pagamento de Comissão
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">



                    <div class="card mb-3">
                        <div class="card-header bg-light">
                            <x-page.user-block :user="$instructor->user" cslass="mb-3">

                                <div class="flex-fill">
                                    <div class="font-weight-medium"> <strong>{{ $instructor->user->name }}</strong>
                                    </div>
                                    <div class="text-secondary">
                                        <a href="#" class="text-reset">{{$instructor->profession}} </a>
                                    </div>
                                </div>

                            </x-page.user-block>
                        </div>
                        <div class="card-body">
                            <div class="row mb-3">

                                <div class="col text-center">
                                    <div class="text-muted">Período:</div>
                                    <h2>
                                        {{ $payStart?->format('d/m') }} à {{ $payEnd?->format('d/m') }}
                                    </h2>
                                </div>
                                <div class="col text-center">
                                    <div class="text-muted">Aulas:</div>
                                    <h2>{{ $count }}</h2>
                                </div>
                                <div class="col text-center">
                                    <div class="text-muted">Valor:</div>
                                    <h2>R$ {{ $amount }}</h2>
                                </div>
                            </div>
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