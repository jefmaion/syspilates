<div>
    @section('title') Alunos @endsection
    <x-page.page-header>
        <h2 class="page-title">
            <x-icons.users />
            Professores
        </h2>
        <x-slot name="actions">
            <div class="btn-list">
                <a href="#" wire:click='$dispatch("create-instructor")' class="btn btn-primary btn-5 d-none d-sm-inline-block">
                    <x-icons.plus class="icon icon-1" /> Novo
                </a>
                <a wire:click='$dispatch("create-instructor")' class="btn btn-primary btn-6 d-sm-none btn-icon" aria-label="Novo">
                    <x-icons.plus class="icon icon-1" />
                </a>
            </div>
        </x-slot>
    </x-page.page-header>

    <x-page.page-card-body>
        <x-table.table>
            <thead>
                <tr>
                    <th scope="col" wsidth="50%">Nome</th>
                    <th>Telefone</th>
                    <th>Status</th>
                    <th scope="col">Data de Cadastro</th>
                    <th scope="col" width="10%">Ações</th>
                </tr>
            </thead>
            <tbody class="table-tbody">
                @foreach($instructors as $item)
                <tr class="align-middle">
                    <td scope="row" class="align-middle">
                        {{-- <div class="d-flex align-items-center">
                            <span class="avatar avatar-sm me-2  {{ ($item->user->gender == 'M') ? 'bg-blue-lt' : 'bg-purple-lt' }}">{{ $item->user->initials }}</span>
                            <a href="{{ route('instructor.show', $item) }}" wire:navigate>{{ $item->user->name }}</a>
                        </div> --}}
                        <x-page.user-block :user="$item->user">
                            <a href="{{ route('instructor.show', $item) }}" wire:navigate>{{ $item->user->name }}</a>
                        </x-page.user-block>
                    </td>
                    <td>{{ $item->user->phone1 }}</td>
                    <td>
                    
                    <span class="badge bg-{{ $item->user->active ? 'green' : 'secondary' }}-lt">{{ $item->user->status }}</span>
                    </td>
                    <td>{{ $item->created_at->format('d/m/Y H:i') }}</td>
                    <td class="text-end">
                        <div class="btn-list flex-nowrap">
                            <x-buttons.button-link href="#" wire:click="$dispatch('edit-instructor', { instructor: {{ $item->id }} })"  class="btn-wsarning bg-orange-lt btn-sm">
                                <x-icons.edit class="" /><span class="d-none d-sm-inline">Editar</span>
                            </x-buttons.button-link>

                            <x-buttons.button-link
                                wire:click="$dispatch('delete-instructor', { instructor: {{ $item->id  }} })"
                                class="btn-dsanger bg-red-lt btn-sm">
                                <x-icons.trash /> <span class="d-none d-sm-inline">Excluir</span>
                            </x-buttons.button-link>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </x-table.table>
        <div class="mt-3">
            {{ $instructors->links() }}
        </div>

        <x-modal.modal-delete />

        <livewire:instructor.instructor-form />



    </x-page.page-card-body>
</div>