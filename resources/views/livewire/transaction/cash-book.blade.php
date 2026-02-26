<div>
    @section('title')
    Lançamentos
    @endsection
    <x-page.page-header>
        <div class="row align-items-center">
            <div class="col-auto">
                <h2 class="page-title">
                    <x-icons.users />
                    Livro Caixa -
                </h2>
            </div>
            <div class="col-auto">
                <x-form.select wire:model.live='month'>
                    <option value="1">Janeiro</option>
                    <option value="2">Fevereiro</option>
                    <option value="3">Março</option>
                    <option value="4">Abril</option>
                    <option value="5">Maio</option>
                    <option value="6">Junho</option>
                    <option value="7">Julho</option>
                    <option value="8">Agosto</option>
                    <option value="9">Setembro</option>
                    <option value="10">Outubro</option>
                    <option value="11">Novembro</option>
                    <option value="12">Dezembro</option>
                </x-form.select>
            </div>
            <div class="col-auto">
                <x-form.select wire:model.live='year'>
                    @for($i=date('Y'); $i>=(date('Y')-3);$i--)
                    <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </x-form.select>
            </div>
        </div>


    </x-page.page-header>

    <x-page.page-body>

        <div class="row mb-3">
            <div class="col">
                <div class="card card-sm">
                    <div class="card-status-top bg-primary"></div>
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <span class="bg-primary-lt avatar">
                                    <!-- Download SVG icon from http://tabler.io/icons/icon/arrow-up -->
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="icon icon-1">
                                        <path d="M12 5l0 14"></path>
                                        <path d="M18 11l-6 -6"></path>
                                        <path d="M6 11l6 -6"></path>
                                    </svg>
                                </span>
                            </div>
                            <div class="col">
                                <div class="text-secondary">Saldo Anterior</div>
                                <div class="font-weight-medium h2">
                                    {{ currency($sald) }}
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card card-sm">
                    <div class="card-status-top bg-green"></div>
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <span class="bg-green-lt avatar">
                                    <!-- Download SVG icon from http://tabler.io/icons/icon/arrow-up -->
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="icon icon-1">
                                        <path d="M12 5l0 14"></path>
                                        <path d="M18 11l-6 -6"></path>
                                        <path d="M6 11l6 -6"></path>
                                    </svg>
                                </span>
                            </div>
                            <div class="col">
                                <div class="text-secondary">Entradas</div>
                                <div class="font-weight-medium h2">
                                    {{ currency($credit) }}
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card card-sm">
                    <div class="card-status-top bg-danger"></div>
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <span class="bg-danger-lt avatar">
                                    <!-- Download SVG icon from http://tabler.io/icons/icon/arrow-up -->
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="icon icon-1">
                                        <path d="M12 5l0 14"></path>
                                        <path d="M18 11l-6 -6"></path>
                                        <path d="M6 11l6 -6"></path>
                                    </svg>
                                </span>
                            </div>
                            <div class="col">
                                <div class="text-secondary">Saídas</div>
                                <div class="font-weight-medium h2">
                                    {{ currency($debit) }}
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col">
                <div class="col">
                    <div class="card card-sm">
                        <div class="card-status-top bg-primary"></div>
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <span class="bg-primary-lt avatar">
                                        <!-- Download SVG icon from http://tabler.io/icons/icon/arrow-up -->
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" class="icon icon-1">
                                            <path d="M12 5l0 14"></path>
                                            <path d="M18 11l-6 -6"></path>
                                            <path d="M6 11l6 -6"></path>
                                        </svg>
                                    </span>
                                </div>
                                <div class="col">
                                    <div class="text-secondary">Saldo Final</div>
                                    <div class="font-weight-medium h2">
                                        {{ currency($amount) }}
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">

            <div class="col-12">

                <div class="card">

                    <div class="card-header">
                        <div class="row">
                            <div class="col">
                                <x-form.select-category wire:model.live='category_id' />
                            </div>
                            <div class="col">
                                <x-form.input-text wire:model.live="search" placeholder="Pesquisar..." />
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <x-table.table :search="false">
                            <thead>
                                <tr>
                                    <th width="10%">Data Vencimento</th>
                                    <th width="10%">Data Pagamento</th>
                                    <th>Descrição</th>
                                    <th class="text-center">Categoria</th>
                                    <th class="text-center">Entrada</th>
                                    <th class="text-center">Saída</th>
                                    <th class="text-center">Saldo</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(!$transactions->isEmpty())
                                @foreach ($transactions as $tran)
                                <tr class="@if ($tran->payed == 0) text-secondary @endif">
                                    <td class="text-center">{{ $tran->date->format('d/m/y') }}</td>
                                    <td class="text-center">{{ $tran->paid_at->format('d/m/y') }}</td>
                                    <td>
                                        {{ $tran->description }}
                                        @if($tran->student)
                                        {{ $tran->student->user->shortName }}
                                        @endif

                                    </td>
                                    <td class="text-center">
                                        {{ $tran->category->name }}
                                    </td>
                                    <td class="text-center text-teal">
                                        <strongs>{{ $tran->type->value == 'C' ? currency($tran->amount) : '-' }}
                                        </strongs>
                                    </td>
                                    <td class="text-center text-danger">
                                        <strongs>{{ $tran->type->value == 'D' ? currency($tran->amount) : '-' }}
                                        </strongs>
                                    </td>
                                    <td class="text-center {{ $tran->apos < 0 ? 'text-danger' : 'text-teal' }}">
                                        <strongs>{{ currency($tran->apos) }}</strongs>
                                    </td>
                                </tr>
                                @endforeach
                                @else
                                <tr>
                                    <td colspan="7" class="text-center">Nenhum Registro Encontrado</td>
                                </tr>
                                @endif
                            </tbody>
                        </x-table.table>
                        <div class="mt-3">
                            {{ $transactions->links() }}
                        </div>
                    </div>
                </div>
            </div>



        </div>



    </x-page.page-body>
</div>