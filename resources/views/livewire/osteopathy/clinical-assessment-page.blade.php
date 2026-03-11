<div>
    <x-page.page-header>
        <h2 class="page-title">
            <x-icons.list />
            Avaliações Clínicas
        </h2>
        <x-slot name="actions">
            <div class="btn-list">
                <a href="{{ route('assessment.create') }}" wire:navigate
                    class="btn btn-primary btn-5 d-none d-sm-inline-block">
                    <x-icons.plus class="icon icon-1" /> Novo
                </a>
                <a href="{{ route('assessment.create') }}" wire:navigate
                    class="btn btn-primary btn-6 d-sm-none btn-icon" aria-label="Novo">
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
                @if ($assessments->isNotEmpty())
                <x-table.table :search="false" class="fs-4">
                    <thead>
                        <tr>
                            <th>Modalidade</th>
                            <th scope="col">Data de Cadastro</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($assessments as $item)
                        <tr class="alsign-middle">
                            <td scope="row">
                                <x-page.user-avatar :user="$item->user">
                                    {{$item->user->name}}
                                </x-page.user-avatar>
                            </td>

                            <td>{{$item->question1}}</td>
                            <td>{{ $item->created_at->format('d/m/Y H:i') }}</td>
                            <td class="btn-actions">
                                <a class="btn btn-action" href="{{ route('assessment.edit', $item) }}" wire:navigate>
                                    <x-icons.edit class="icon icon-1" />
                                </a>
                                <a class="btn btn-action"
                                    wire:click="$dispatch('delete-modality', { modality: {{ $item->id }} })">
                                    <x-icons.trash class="icon icon-1" />
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </x-table.table>
                <div class="mt-3">
                    {{ $assessments->links() }}
                </div>
                @else
                <div class="text-center">Nenhum registro encontrado.</div>
                @endif
            </div>


    </x-page.page-body>
</div>