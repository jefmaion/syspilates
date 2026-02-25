<div>
    @section('title')
    Alunos
    @endsection

    <livewire:student.student-form />

    <x-page.page-header>

        <h2 class="page-title">
            <x-icons.users />
            Alunos
        </h2>
        @can('create student')
        <x-slot name="actions">
            <div class="btn-list">
                <a href="#" wire:click.prevent='$dispatch("create-student")'
                    class="btn btn-primary btn-5 d-none d-sm-inline-block">

                    <x-icons.plus class="icon icon-1" /> Novo
                </a>
                <a wire:click.prevent='$dispatch("create-student")' class="btn btn-primary btn-6 d-sm-none btn-icon"
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
                <x-table.table :search="false">
                    <thead>
                        <tr>
                            <th scope="col" wsidth="50%">Nome</th>
                            {{-- <th>Telefone</th> --}}
                            <th>Telefone</th>
                            <th>Email</th>
                            <th>Idade</th>
                            <th>Gênero</th>
                            <th>Status</th>
                            <th scope="col">Data de Cadastro</th>
                        </tr>
                    </thead>
                    <tbody class="table-tbody">
                        @foreach($students as $item)
                        <tr class="align-middle">
                            <td scope="row" class="align-middle">

                                <x-page.user-avatar :user="$item->user">
                                    <a href="{{ route('student.show', $item) }}" wire:navigate>{{ $item->user->name
                                        }}</a>
                                </x-page.user-avatar>

                            </td>
                            <td>
                                {{ $item->user->phone1 }}
                            </td>
                            <td>
                                {{ $item->user->email }}
                            </td>
                            <td>
                                {{ $item->user->age }}
                            </td>
                            <td>
                                {{ $item->user->gender }}
                            </td>
                            <td>
                                <x-page.status color="{{ ($item->hasRegistration) ? 'green' : 'secondary' }}">
                                    @if($item->hasRegistration)
                                    Ativo
                                    @else
                                    Sem Matrícula
                                    @endif
                                </x-page.status>
                            </td>
                            <td>{{ $item->created_at->format('d/m/Y H:i') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </x-table.table>

                <div class="mt-3">
                    {{ $students->links(data: ['scrollTo' => false]) }}
                </div>
            </div>
        </div>

        <x-modal.modal-delete />




    </x-page.page-body>
</div>