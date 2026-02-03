<div>
    @section('title') Lançamentos @endsection
    <x-page.page-header>
        <h2 class="page-title">
            <x-icons.users />
            Lançamentos
        </h2>
        <x-slot name="actions">
                
        </x-slot>
    </x-page.page-header>

    <x-page.page-body>

     

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
                        <x-form.select-duration wire:model.live='duration' placeholder="opa" />
                    </div>
                    <div class="col-auto">
                        <x-form.select-modality wire:model.live='modality_id' />
                    </div>
                    <div class="col">
                        <input type="text" wire:model.live='search' class="form-control w-100"
                            placeholder="Pesquisar aluno...">
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
                            <th>Plano</th>
                        </tr>
                    </thead>
                    <tbody class="table-tbody">
                        @foreach($transactions as $item)
                        <tr>
                            <td >
                                {{ $item->date->format('d/m/y') }}
                            </td>
                            <td>
                                <x-page.badge color="{{ $item->currentStatus->color }}">{{ $item->currentStatus->label }}</x-page.badge>
                            </td>
                            <td>
                                {{ $item->description }}
                            </td>
                            <td>
                                {{ $item->student?->user->shortName }}
                            </td>
                            <td>
                                {{ currency($item->amount) }}
                            </td>
                            
                            <td>
                                <x-page.status color="{{ $item->type->color() }}">{{ $item->type->label() }}</x-page.status>
                            </td>
                            <td>
                                {{ $item->paid_at?->format('d/m/y') }}
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