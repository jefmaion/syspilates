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
                        <th>Telefone</th>
                        <th>Status</th>
                        <th scope="col">Data de Cadastro</th>
                    </tr>
                </thead>
                <tbody class="table-tbody">
                    @foreach($students as $item)
                    <tr class="align-middle">
                        <td scope="row" class="align-middle">
                            <div class="d-flex align-items-center">
                                <span
                                    class="avatar avatar-sm me-2  {{ ($item->user->gender == 'M') ? 'bg-blue-lt' : 'bg-purple-lt' }}">{{
                                    $item->user->initials }}</span>
                                <a href="{{ route('student.show', $item) }}" wire:navigate>{{ $item->user->name }}</a>
                            </div>
                        </td>
                        <td class="d-flex">
                            <div class="flex-fill">
                                <div><strong>{{ $item->user->phone1 }}</strong></div>
                                <div class="text-muted"><small>{{ $item->user->email}}</small></div>
                            </div>
                        </td>
                        <td><x-page.status>Ativo</x-page.status></td>
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
