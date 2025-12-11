<div>
    <x-page.page-header>
        <h2 class="page-title">
            <x-icons.users />
            Alunos
        </h2>
        <x-slot name="actions">
            <div class="btn-list">
                <a href="{{ route('student.create') }}" wire:navigate
                    class="btn btn-primary btn-5 d-none d-sm-inline-block">
                    <x-icons.plus class="icon icon-1" /> Novo
                </a>
                <a href="{{ route('student.create') }}" wire:navigate class="btn btn-primary btn-6 d-sm-none btn-icon" aria-label="Novo">
                    <x-icons.plus class="icon icon-1" />
                </a>
            </div>
        </x-slot>

    </x-page.page-header>

    <x-page.page-body>
        
            <x-table.table>
                <thead>
                    <tr>
                        <th scope="col" width="50%">Modalidade</th>
                        <th scope="col">Data de Cadastro</th>
                        <th scope="col" width="10%">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($students as $item)
                    <tr class="align-middle">   
                        <td scope="row">{{ $item->user->name }}</td>
                        <td>{{ $item->created_at->format('d/m/Y H:i') }}</td>
                        <td class="text-end">
                            <div class="btn-list flex-nowrap">
                                <x-buttons.button-link href="{{ route('student.edit', $item) }}" class="btn-warning">
                                    <x-icons.edit class="" /><span class="d-none d-sm-inline">Editar</span>
                                </x-buttons.button-link>

                                <x-buttons.button-link wire:click="$dispatch('delete-student', { student: {{ $item->id  }} })" class="btn-danger">
                                    <x-icons.trash /> <span class="d-none d-sm-inline">Excluir</span>
                                </x-buttons.button-link>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </x-table.table>
            <div class="mt-3">
                {{ $students->links() }}
            </div>

        <livewire:student.delete-student />
    </x-page.page-body>
</div>