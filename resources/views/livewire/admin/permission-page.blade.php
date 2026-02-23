<div>
    @section('title')
    Permissões
    @endsection
    <x-page.page-header>

        <h2 class="page-title">
            <x-icons.users />
            Permissões
        </h2>
    </x-page.page-header>



    <x-page.page-body>
        <div class="card">
            <div class="card-body">
                <a href="#" wire:click='save' class="btn btn-primary btn-5 d-none d-sm-inline-block">

                    <x-icons.plus class="icon icon-1" /> Novo
                </a>
                <x-table.table :search="false">
                    <thead>
                        <tr>
                            <th scope="col">Permissão</th>
                            @foreach($roles as $role)
                            <th>{{ $role->name }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody class="table-tbody">
                        @foreach($permissions as $i => $permission)
                        <tr class="align-middle">
                            <td>{{ $permission->label }}</td>
                            @foreach($roles as $role)
                            <td class="align-middle text-center">
                                <x-form.checkbox wire:model='roless' value="{{ $role->id }}.{{ $permission->id}}" />
                            </td>
                            @endforeach
                        </tr>
                        @endforeach
                    </tbody>
                </x-table.table>
            </div>
        </div>
    </x-page.page-body>

</div>