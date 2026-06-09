<div>
    <x-page.page-header>
        <h2 class="page-title">
            <x-icons.list />
            Permissões
        </h2>
        <x-slot name="actions">
            @can('modalities.create')
            <div class="btn-list">
                <a href="#" wire:click='$dispatch("create-role")'
                    class="btn btn-primary btn-5 d-none d-sm-inline-block">
                    <x-icons.plus class="icon icon-1" /> Novo Grupo
                </a>
                <a href="#" wire:click='$dispatch("create-role")' class="btn btn-primary btn-6 d-sm-none btn-icon"
                    aria-label="Novo">
                    <x-icons.plus class="icon icon-1" />
                </a>
            </div>
            @endcan
        </x-slot>

    </x-page.page-header>

    <x-page.page-body>



        <div class="card">


            <div class="card-bodys">



                <x-table.table :search="false" class="fs-4">
                    <thead>
                        <tr>
                            <th></th>
                            @foreach($roles as $role)
                            <th><a href="#" wire:click="$dispatch('edit-role', '{{$role->id}}')"><h3>{{ $role->name }}</h3></a></th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                       @foreach($permissions as $group => $items)
                        <tr>
                            <th class="bg-grey" colspan="{{ count($roles)+1 }}"><h2 class="m-0">{{ $group }}</h2></th>
                        </tr>
                        @foreach ($items as $item)
                        <tr class="alsign-middle">
                            <td scope="row">
                                {{ $item->label }}
                            </td>
                            @foreach($roles as $role)
                            <td class="text-center" >

                                    <label class="form-check form-check-single form-switch">
                                        <input class="form-check-input"  wire:click='_sync({{$role->id}}, "{{$item->name}}", {{$role->hasPermissionTo($item->name)}})'  type="checkbox" {{ ($role->hasPermissionTo($item->name)) ? 'checked' : '' }} >
                                    </label>

                            </td>
                            @endforeach
                        </tr>
                        @endforeach
                        @endforeach
                    </tbody>
                </x-table.table>

            </div>
            <livewire:modality.delete-modality />
            <livewire:role.role-form />

    </x-page.page-body>
</div>
