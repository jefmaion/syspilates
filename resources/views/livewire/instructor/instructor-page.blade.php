<div>
    @section('title') Alunos @endsection
    <x-page.page-header>
        <h2 class="page-title">
            <x-icons.users />
            Professores
        </h2>
        @can('create instructor')
        <x-slot name="actions">
            <div class="btn-list">
                <a href="#" wire:click='$dispatch("create-instructor")'
                    class="btn btn-primary btn-5 d-none d-sm-inline-block">
                    <x-icons.plus class="icon icon-1" /> Novo
                </a>
                <a wire:click='$dispatch("create-instructor")' class="btn btn-primary btn-6 d-sm-none btn-icon"
                    aria-label="Novo">
                    <x-icons.plus class="icon icon-1" />
                </a>
            </div>
        </x-slot>
        @endcan
    </x-page.page-header>

    <x-page.page-body>
        <div class="card">
            <div class="card-header">
                <x-table.table-search />
            </div>
            <div class="card-body">
                <x-table.table :search="false" class="fs-4">
                    <thead>
                        <tr>
                            <th scope="col" wsidth="50%">Nome</th>
                            <th>Telefone</th>
                            <th>Status</th>
                            <th scope="col">Data de Cadastro</th>
                        </tr>
                    </thead>
                    <tbody class="table-tbody">
                        @foreach($instructors as $item)
                        <tr class="align-middle">
                            <td scope="row" class="align-middle">
                                <x-page.user-block :user="$item->user">
                                    <a href="{{ route('instructor.show', $item) }}" wire:navigate>
                                        <div class="flex-fill">
                                            <div class="font-weight-medium"> <strong>{{ $item->user->name }}</strong>
                                            </div>
                                            <div class="text-secondary">
                                                <a href="#" class="text-reset">{{$item->profession}} </a>
                                            </div>
                                        </div>
                                    </a>
                                </x-page.user-block>
                            </td>
                            <td class="d-flex">
                                <div class="flex-fill">
                                    <div><strong>{{ $item->user->phone1 }}</strong></div>
                                    <div class="text-muted"><small>{{ $item->user->email}}</small></div>
                                </div>
                            </td>
                            <td>
                                <x-page.status color="{{ $item->user->active ? 'green' : 'secondary' }}">
                                    {{$item->user->status }}</x-page.status>
                            </td>
                            <td>{{ $item->created_at->format('d/m/Y H:i') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </x-table.table>
                <div class="mt-3">
                    {{ $instructors->links() }}
                </div>
            </div>
            <x-modal.modal-delete />
            <livewire:instructor.instructor-form />
        </div>
    </x-page.page-body>
</div>