<div>
    <x-page.page-header>
        <h2 class="page-title">
            <x-icons.list />
            Usuários do Sistema
        </h2>
        <x-slot name="actions">
            @can('modalities.create')
            <div class="btn-list">
                <a href="#" wire:click='$dispatch("create-user")'
                    class="btn btn-primary btn-5 d-none d-sm-inline-block">
                    <x-icons.plus class="icon icon-1" /> Novo
                </a>
                <a href="#" wire:click='$dispatch("create-user")' class="btn btn-primary btn-6 d-sm-none btn-icon"
                    aria-label="Novo">
                    <x-icons.plus class="icon icon-1" />
                </a>
            </div>
            @endcan
        </x-slot>

    </x-page.page-header>

    <x-page.page-body>



        <div class="card">


            <div class="card-body">



                <x-table.table :search="false" class="fs-4">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Grupos</th>
                            <th>Status</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr class="alsign-middle">
                            <td scope="row">
                                <x-page.user-block :user="$user">
                                    <div class="flex-fill">
                                        <div class="font-weight-medium"> <strong>{{ $user->name }}</strong>
                                        </div>
                                        <div class="text-secondary">
                                            <a href="#" class="text-reset">{{$user->email}} </a>
                                        </div>
                                    </div>
                                </x-page.user-block>
                            </td>

                            <td>
                                @foreach($user->roles as $role)
                                <span class="badge badge-outline text-indigo">{{ $role->name}}</span>
                                @endforeach
                            </td>

                            <td>
                                <label class="form-check form-check-single form-switch">
                                        <input class="form-check-input"  type="checkbox" checked="">
                                    </label>
                            </td>

                            <td class="text-center">
                                <div class="btn-actions">
                                    <a class="btn btn-action">
                                        <!-- Download SVG icon from http://tabler.io/icons/icon/edit -->
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" class="icon icon-1">
                                            <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                                            <path
                                                d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z">
                                            </path>
                                            <path d="M16 5l3 3"></path>
                                        </svg>
                                    </a>
                                    <a class="btn btn-action">
                                        <!-- Download SVG icon from http://tabler.io/icons/icon/copy -->
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" class="icon icon-1">
                                            <path
                                                d="M7 7m0 2.667a2.667 2.667 0 0 1 2.667 -2.667h8.666a2.667 2.667 0 0 1 2.667 2.667v8.666a2.667 2.667 0 0 1 -2.667 2.667h-8.666a2.667 2.667 0 0 1 -2.667 -2.667z">
                                            </path>
                                            <path
                                                d="M4.012 16.737a2.005 2.005 0 0 1 -1.012 -1.737v-10c0 -1.1 .9 -2 2 -2h10c.75 0 1.158 .385 1.5 1">
                                            </path>
                                        </svg>
                                    </a>
                                    <a class="btn btn-action">
                                        <!-- Download SVG icon from http://tabler.io/icons/icon/settings -->
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" class="icon icon-1">
                                            <path
                                                d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065z">
                                            </path>
                                            <path d="M9 12a3 3 0 1 0 6 0a3 3 0 0 0 -6 0"></path>
                                        </svg>
                                    </a>
                                    <a class="btn btn-action">
                                        <!-- Download SVG icon from http://tabler.io/icons/icon/clipboard -->
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" class="icon icon-1">
                                            <path
                                                d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2">
                                            </path>
                                            <path
                                                d="M9 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z">
                                            </path>
                                        </svg>
                                    </a>
                                    <a class="btn btn-action">
                                        <!-- Download SVG icon from http://tabler.io/icons/icon/x -->
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" class="icon icon-1">
                                            <path d="M18 6l-12 12"></path>
                                            <path d="M6 6l12 12"></path>
                                        </svg>
                                    </a>
                                </div>

                            </td>

                        </tr>
                        @endforeach

                    </tbody>
                </x-table.table>

            </div>
            <livewire:user.user-form />

    </x-page.page-body>
</div>
