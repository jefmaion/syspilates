<div>

    <div class="container-fluid mt-3">
        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
    </div>

    <x-page.page-header>
        <h2 class="page-title">
            <x-icons.list />
            Modalidades
        </h2>

        <x-slot name="actions">
            <div class="btn-list">
                <a href="{{ route('modality.create') }}" wire:navigate
                    class="btn btn-primary btn-5 d-none d-sm-inline-block">
                    <x-icons.plus class="icon icon-1" /> Novo
                </a>
                <a href="{{ route('modality.create') }}" wire:navigate class="btn btn-primary btn-6 d-sm-none btn-icon"
                    aria-label="Novo">
                    <x-icons.plus class="icon icon-1" />
                </a>
            </div>
        </x-slot>


    </x-page.page-header>

    <x-page.page-body>
        <div class="table-responsive">

            <div class="d-flex mb-4">
                <div class="text-secondary">
                    Show
                    <div class="mx-2 d-inline-block">
                        <input type="text" class="form-control" wire:model.live='pages' size="3" aria-label="Invoices count">
                    </div>
                    entries
                </div>
                <div class="ms-auto text-secondary">
                    Search:
                    <div class="ms-2 d-inline-block">
                        <input type="text"  wire:model.live='search' class="form-control" aria-label="Search invoice">
                    </div>
                </div>
            </div>

            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Modalidade</th>
                        <th scope="col">Data de Cadastro</th>
                        <th scope="col">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($modalities as $item)
                    <tr class="align-middle">
                        <td scope="row">{{ $item->name }}</td>
                        <td>{{ $item->created_at->format('d/m/Y H:i') }}</td>
                        <td>
                            <div class="btn-list flex-nowrap">
                                <a href="{{ route('modality.edit', $item) }}" wire:navigate
                                    class="btn btn-1 btn-warning"> Editar </a>
                                <a href="#" wire:click="$dispatch('delete-modality', { modality: {{ $item->id  }} })"
                                    class="btn btn-1 btn-danger"> Excluir </a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $modalities->links() }}
        </div>
        <livewire:modality.delete-modality />
    </x-page.page-body>
</div>