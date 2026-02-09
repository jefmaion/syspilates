<div>
    <x-page.page-header>
        <h2 class="page-title">
            <x-icons.list />
            Modalidades
        </h2>
        <x-slot name="actions">
            <div class="btn-list">
                <a href="#" wire:click='$dispatch("create-modality")' class="btn btn-primary btn-5 d-none d-sm-inline-block">
                    <x-icons.plus class="icon icon-1" /> Novo
                </a>
                <a href="#" wire:click='$dispatch("create-modality")' class="btn btn-primary btn-6 d-sm-none btn-icon" aria-label="Novo">
                    <x-icons.plus class="icon icon-1" />
                </a>
            </div>
        </x-slot>

    </x-page.page-header>

    <x-page.page-body>



        <div class="card">
            <div class="card-header">
                <x-table.table-search />
            </div>

            <div class="card-body">
                @if ($modalities->isNotEmpty())
                    <x-table.table :search="false" class="fs-4">
                        <thead>
                            <tr>
                                <th>Modalidade</th>
                                <th scope="col">Data de Cadastro</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($modalities as $item)
                                <tr class="align-middle">
                                    <td scope="row">
                                        {{ $item->name }} @if (!empty($item->acronym))
                                            ({{ $item->acronym }})
                                        @endif
                                    </td>
                                    <td>{{ $item->created_at->format('d/m/Y H:i') }}</td>
                                    <td class="text-end">



                                        <div class="btn-actions">
                                            <a class="btn btn-action" wire:click="$dispatch('edit-modality', {modality: {{ $item }}})"><!-- Download SVG icon from http://tabler.io/icons/icon/edit -->
                                                <x-icons.edit class="" /></a>
                                            <a class="btn btn-action text-danger" wire:click="$dispatch('delete-modality', { modality: {{ $item->id }} })"><!-- Download SVG icon from http://tabler.io/icons/icon/copy -->
                                                <x-icons.trash /></a>

                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </x-table.table>
                    <div class="mt-3">
                        {{ $modalities->links() }}
                    </div>
                @else
                    <div class="text-center">Nenhum registro encontrado.</div>
                @endif
            </div>
            <livewire:modality.delete-modality />
            <livewire:modality.modality-form />

    </x-page.page-body>
</div>
