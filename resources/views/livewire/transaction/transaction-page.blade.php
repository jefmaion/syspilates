<div>
    @section('title') Lançamentos @endsection
    <x-page.page-header>
        <h2 class="page-title">
            <x-icons.users />
            Lançamentos
        </h2>
        <x-slot name="actions">
            <a href="#" class="btn btn-primary" wire:click="$dispatch('create-transaction')">Novo</a>
        </x-slot>
    </x-page.page-header>

    <x-page.page-body>


        <x-modal.modal-delete />
        <livewire:transaction.create-transaction />


        <div class="row mb-3">
            @foreach($box as $item)
            <div class="col">
                <div class="card card-sm">
                  <div class="card-body">
                    <div class="row align-items-center">
                      <div class="col-auto">
                        <span class="bg-{{ $item['icon'] }}-lt avatar"><!-- Download SVG icon from http://tabler.io/icons/icon/currency-dollar -->
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" 
                          class="icon icon-1">
                            <path d="M16.7 8a3 3 0 0 0 -2.7 -2h-4a3 3 0 0 0 0 6h4a3 3 0 0 1 0 6h-4a3 3 0 0 1 -2.7 -2"></path>
                            <path d="M12 3v3m0 12v3"></path></svg></span>
                      </div>
                      <div class="col">
                          <div class="text-secondary">{{ $item['label'] }}</div>
                        <div class="font-weight-medium">{{ currency($item['value']) }}</div>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
            @endforeach
        </div>



        <div class="card">
            <div class="card-header">
                {{--
                <x-table.table-search /> --}}
                <div class="row flex-fill">
                    <div class="col-auto">
                        <div class="d-flex align-items-center">
                            <x-form.input-text type="date" wire:model.live='start' />
                            <span class="mx-2"> Até </span>
                            <x-form.input-text type="date" wire:model.live='end' />
                        </div>
                    </div>
                    <div class="col-auto">
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
                        <x-form.select-transaction-type wire:model.live='filter.type' />
                    </div>

                    <div class="col-auto">
                        <x-form.select-student wire:model.live='filter.student_id'  />
                    </div>

                    <div class="col">
                        <input type="text" wire:model.live="filter.description" class="form-control" placeholder="Pesquisar..." aria-label="Search invoice">
                    </div>
                  
                  
                </div>
            </div>
            <div class="card-body">

                <x-table.table :search="false">
                    <thead>
                        <tr>
                            <th>Data</th>
                            <th>Tipo</th>
                            <th>Descrição</th>
                            <th>Categoria</th>
                            <th>Aluno</th>
                            <th>Aluno</th>
                            <th>Plano</th>
                        </tr>
                    </thead>
                    <tbody class="table-tbody">
                        @foreach($transactions as $item)
                        <tr>
                            <td>
                                {{ $item->date->format('d/m/y') }}
                            </td>
                            <td>
                                <x-page.badge  color="{{ $item->currentStatus->color }}">{{ $item->currentStatus->label
                                    }}</x-page.badge>
                            </td>
                            <td>
                                {{ $item->description }}
                            </td>
                            <td>
                                {{ $item->student?->user->shortName }}
                            </td>

                             <td>
                                {{ $item->category?->name }}
                            </td>
                            <td>
                                <span class="text-{{ $item->type->color() }}"><strong>{{ currency($item->amount)
                                        }}</strong></span>
                            </td>

                            <td>
                                <x-page.status color="{{ $item->type->color() }}">{{ $item->type->label() }}
                                </x-page.status>
                            </td>
                            <td>
                                {{ $item->paid_at?->format('d/m/y') }}
                            </td>
                            <td>
                                {{-- <a href="#" class="btn btn-primary btn-sm"
                                    wire:click="$dispatch('edit-transaction', {id: {{ $item->id }}})">Editar</a> --}}

                                <div class="dropdown">
                                    <a href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-dots"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 12a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" /><path d="M11 12a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" /><path d="M18 12a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" /></svg>
                                    </a>
                                    <div class="dropdown-menu">
                                        <span class="dropdown-header">Ações</span>
                                        <a class="dropdown-item" href="#" wire:click="$dispatch('edit-transaction', {id: {{ $item->id }}})">
                                             <!-- Download SVG icon from http://tabler.io/icons/icon/edit -->
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon dropdown-item-icon icon-2">
                                            <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                                            <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path>
                                            <path d="M16 5l3 3"></path>
                                            </svg>
                                            Editar
                                        </a>
                                        @if(empty($item->registration_id))
                                        <a class="dropdown-item" href="#" wire:click="deleteTransaction({{ $item->id }})">
                                            <!-- Download SVG icon from http://tabler.io/icons/icon/edit -->
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon dropdown-item-icon icon-2">
                                            <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                                            <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path>
                                            <path d="M16 5l3 3"></path>
                                            </svg>
                                            Excluir
                                        </a>
                                        @endif
                                    </div>
                                      
                                    </div>
                                </div>

                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </x-table.table>
                <div class="mt-3">
                    {{ $transactions->links(data:['scroll' => false]) }}
                </div>
            </div>
        </div>

        <x-modal.modal-delete />

    </x-page.page-body>
</div>