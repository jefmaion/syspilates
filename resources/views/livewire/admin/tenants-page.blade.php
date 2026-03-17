<div>
    <x-page.page-header>
        <h2 class="page-title">
            <x-icons.list />
            Avaliações Clínicas
        </h2>
        <x-slot name="actions">
            <div class="btn-list">
                <a href="#" wire:click='create()' class="btn btn-primary btn-5 d-none d-sm-inline-block">
                    <x-icons.plus class="icon icon-1" /> Novo
                </a>
                <a href="#" wire:click='create()' class="btn btn-primary btn-6 d-sm-none btn-icon" aria-label="Novo">
                    <x-icons.plus class="icon icon-1" />
                </a>
            </div>
        </x-slot>

    </x-page.page-header>

    <x-page.page-body>

        <livewire:admin.create-tenant />


        <div class="card">
            <div class="card-header">
                <x-table.table-search />
            </div>

            <div class="card-body">
                @if ($tenants->isNotEmpty())
                <x-table.table :search="false" class="fs-4">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th scope="col">URL</th>
                            <th scope="col">Responsável</th>
                            <th scope="col">Telefone</th>
                            <th scope="col">Status</th>
                            <th scope="col">Data Ativação</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tenants as $item)
                        <tr class="alsign-middle">
                            <td>{{ $item->company_name }}</td>
                            <td>{{ $item->subdomain }}.{{ getenv('APP_SERVER') }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->phone }}</td>
                            <td></td>
                            <td>{{ $item->created_at->format('d/m/Y H:i') }}</td>
                            <td>
                                <a href="#" wire:click='edit({{$item}})'>Editar</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </x-table.table>
                <div class="mt-3">
                    {{ $tenants->links() }}
                </div>
                @else
                <div class="text-center">Nenhum registro encontrado.</div>
                @endif
            </div>


    </x-page.page-body>
</div>