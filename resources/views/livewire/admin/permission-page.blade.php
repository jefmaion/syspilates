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

        <a href="#" wire:click='save' class="btn btn-primary btn-5 d-none d-sm-inline-block">

            <x-icons.plus class="icon icon-1" /> Novo
        </a>

        @foreach($permissions as $group => $perms)
        <div class="card mb-3">
            <div class="card-header">
                <h2 class="casrd-title">{{ $group }}</h2>
            </div>
            <div class="card-bodys">

                <x-table.table :search="false">
                    <thead>
                        <tr>
                            <th scope="col" width="40%">Permissão</th>
                            @foreach($roles as $role)
                            <th class="text-center">{{ $role->name }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody class="table-tbody">
                        @foreach($perms as $i => $permission)
                        <tr class="align-middle">
                            <td>{{ $permission->label }}</td>
                            @foreach($roles as $role)
                            <td class="text-center ">
                                <div class="d-flex align-items-middle">
                                    <x-form.checkbox wire:model='roless' value="{{ $role->id }}.{{ $permission->id}}" />
                                </div>
                            </td>
                            @endforeach
                        </tr>
                        @endforeach
                    </tbody>
                </x-table.table>
            </div>
        </div>
        @endforeach
    </x-page.page-body>

</div>