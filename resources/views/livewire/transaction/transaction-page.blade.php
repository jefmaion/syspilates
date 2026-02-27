<div>
    @section('title')
    Lançamentos
    @endsection
    <x-page.page-header>
        <div class="d-flex">
            <h2 class="page-title">
                <x-icons.users />
                Lançamentos -
            </h2>
            <span class="d-flex align-items-center ms-2">
                <x-form.input-text type="date" wire:model.live='start' />
                <span class="mx-2 text-muted"> Até </span>
                <x-form.input-text type="date" wire:model.live='end' />
            </span>
        </div>
        @can('create transaction')
        <x-slot name="actions">
            <a href="#" class="btn btn-primary" wire:click="$dispatch('create-transaction')">
                <x-icons.success /> Novo Lançamento
            </a>
        </x-slot>
        @endcan
    </x-page.page-header>

    <x-page.page-body>


        <x-modal.modal-delete subtext="{{ $deleteText ?? null }}" />
        <livewire:transaction.form-transaction />
        <livewire:transaction.pay-transaction />

        <div class="row mb-3">
            <div class="col-lg-3">
                <div class="card">
                    <div class="card-body d-flex ">
                        <div class="row">
                            <div class="col-auto">
                                <span class="bg-teal text-white avatar avatar-lg">
                                    <!-- Download SVG icon from http://tabler.io/icons/icon/currency-dollar -->
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
                                <div class="d-flex align-items-center">
                                    <div class="subheader">Total a receber</div>
                                </div>
                                <div class="h1">R$ {{ $credit }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card">
                    <div class="card-body d-flex ">
                        <div class="row">
                            <div class="col-auto">
                                <span class="bg-danger text-white avatar avatar-lg">
                                    <!-- Download SVG icon from http://tabler.io/icons/icon/currency-dollar -->
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-arrow-narrow-down">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M12 5l0 14" />
                                        <path d="M16 15l-4 4" />
                                        <path d="M8 15l4 4" />
                                    </svg>
                                </span>
                            </div>
                            <div class="col">
                                <div class="d-flex align-items-center">
                                    <div class="subheader">Total a pagar</div>
                                </div>
                                <div class="h1">{{ $debit }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3">
                <div class="card">
                    <div class="card-body d-flex ">
                        <div class="row">
                            <div class="col-auto">
                                <span class="bg-warning text-white avatar avatar-lg">
                                    <!-- Download SVG icon from http://tabler.io/icons/icon/currency-dollar -->
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
                                <div class="d-flex align-items-center">
                                    <div class="subheader">À Receber HOJE</div>
                                </div>
                                <div class="h1">R$ {{ $creditToday }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card">
                    <div class="card-body d-flex ">
                        <div class="row">
                            <div class="col-auto">
                                <span class="bg-purple text-white avatar avatar-lg">
                                    <!-- Download SVG icon from http://tabler.io/icons/icon/currency-dollar -->
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-arrow-narrow-down">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M12 5l0 14" />
                                        <path d="M16 15l-4 4" />
                                        <path d="M8 15l4 4" />
                                    </svg>
                                </span>
                            </div>
                            <div class="col">
                                <div class="d-flex align-items-center">
                                    <div class="subheader">À PAGAR HOJE</div>
                                </div>
                                <div class="h1">R$ {{ $debitToday }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- <div class="row mb-3">
            @foreach ($box as $title => $data)
            <div class="col">
                <div class="card card-sm">
                    <div class="card-status-top bg-{{ $data['color'] ?? 'primary' }}"></div>
                    <div class="card-body p-3">
                        <div class="card-title">{{ $title }}</div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <span class="bg-green-lt avatar avatar-xs">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round" class="icon icon-1">
                                                <path d="M12 5l0 14"></path>
                                                <path d="M18 11l-6 -6"></path>
                                                <path d="M6 11l6 -6"></path>
                                            </svg>
                                        </span>
                                    </div>
                                    <div class="col ps-0">
                                        <div class="font-weight-medium h4 mb-0">
                                            R$ {{ currency($data['credit']) }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <span class="bg-danger-lt avatar avatar-xs">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="icon icon-tabler icons-tabler-outline icon-tabler-arrow-narrow-down">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M12 5l0 14" />
                                                <path d="M16 15l-4 4" />
                                                <path d="M8 15l4 4" />
                                            </svg>
                                        </span>
                                    </div>
                                    <div class="col ps-0">
                                        <div class="font-weight-medium h4 mb-0">
                                            R$ {{ currency($data['debit']) }}
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div> --}}

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">

                        <div class="row flex-fill">

                            <div class="col-auto">
                                <label class="form-label">Status</label>
                                <x-form.select wire:model.live='filter.status' placeholder="opa">
                                    <option value=""></option>
                                    <option value="open">Abertos</option>
                                    <option value="payed">Pago</option>
                                    <option value="today">Vencem Hoje</option>
                                    <option value="late">Atrasados</option>
                                    <option value="soon">Próx. a Vencer</option>
                                </x-form.select>
                            </div>

                            <div class="col-auto">
                                <label class="form-label">Tipo</label>
                                <x-form.select-transaction-type wire:model.live='filter.type' />
                            </div>

                            <div class="col-auto">
                                <label class="form-label">Aluno</label>
                                <x-form.select-student wire:model.live='filter.student_id' />
                            </div>

                            <div class="col">
                                <label class="form-label">Pesquisar</label>
                                <input type="text" wire:model.live="filter.description" class="form-control"
                                    placeholder="Pesquisar..." aria-label="Search invoice">
                            </div>

                        </div>
                    </div>
                    <div class="card-body">

                        <x-table.table :search="false">
                            <thead>
                                <tr>
                                    <th width="10%">Vencimento</th>
                                    {{-- <th>Data</th> --}}
                                    <th>Status</th>
                                    <th>Descrição</th>
                                    <th>Categoria</th>

                                    <th>Tipo</th>
                                    <th>Valor</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody class=" table-tbody">
                                @if(!$transactions->isEmpty())
                                @foreach ($transactions as $item)
                                <tr>
                                    <td>
                                        {{ $item->date->format('d/m/y') }}
                                    </td>
                                    {{-- <td>
                                        {{ $item->paid_at?->format('d/m/y') ?? '-' }}
                                    </td> --}}
                                    <td>
                                        <x-page.badge color="{{ $item->currentStatus->color }}">{{
                                            $item->currentStatus->label }}</x-page.badge>
                                    </td>
                                    <td>
                                        {{ $item->description }}
                                    </td>

                                    <td>
                                        {{ $item->category?->name }}
                                    </td>


                                    <td>


                                        <span class="status-{{ $item->type->color() }}">
                                            <span class="status-dot"></span>
                                            {{$item->type->label()}}
                                        </span>

                                    </td>
                                    <td>
                                        <strong>R$ {{
                                            currency($item->amount)
                                            }}</strong>
                                    </td>

                                    <td class="text-center btn-actions">


                                        <button type="button" class="btn btn-action" wire:click="pay({{ $item->id }})"
                                            @disabled($item->paid_at)>
                                            <!-- Download SVG icon from http://tabler.io/icons/icon/edit -->
                                            <x-icons.money class="icon icon-1" />
                                        </button>

                                        @can('edit transaction')
                                        <button type="button" class="btn  btn-action"
                                            wire:click="$dispatch('edit-transaction', {id: {{ $item->id }}})">
                                            <!-- Download SVG icon from http://tabler.io/icons/icon/edit -->
                                            <x-icons.edit class="icon icon-1" />
                                        </button>
                                        @endcan

                                        @can('delete transaction')
                                        <button type="button" class="btn  btn-action"
                                            wire:click="deleteTransaction({{ $item->id }})">
                                            <!-- Download SVG icon from http://tabler.io/icons/icon/x -->
                                            <x-icons.trash class="icon icon-1" />
                                        </button>
                                        @endcan




                                    </td>
                                </tr>
                                @endforeach
                                @else
                                <tr>
                                    <td class="text-center" colspan="7">Nenhum registro encontrado!</td>
                                </tr>
                                @endif
                            </tbody>
                        </x-table.table>
                        <div class="mt-3">
                            {{ $transactions->links(data: ['scroll' => false]) }}
                        </div>
                    </div>
                </div>

            </div>

            <x-modal.modal-delete />

    </x-page.page-body>
</div>