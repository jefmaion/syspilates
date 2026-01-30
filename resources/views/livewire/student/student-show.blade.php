<div>
    <livewire:student.student-form />

    @section('title')
    Detalhes do Aluno
    @endsection

    <x-page.page-header>
        <div class="page-pretitle">Overview</div>
        <h2 class="page-title">
            <x-icons.users />
            Detalhes do Aluno
        </h2>
    </x-page.page-header>

    <x-page.page-show>
        <x-slot:left>
            <div class="card flex-fill mb-3">
                <div>
                    <div class="card-body p-4 text-center">
                        <span class="avatar avatar-xl mb-3">
                            {{ $student->user->initials }}
                        </span>
                        <h3 class="m-0 mb-1"><a href="#">{{ $student->user->name }}</a></h3>
                        <div class="text-secondary">UI Designer</div>
                        <div class="mt-3">
                            <x-page.status color="{{ $student->user->active ? 'green' : 'secondary' }}">
                                {{$student->user->status }}</x-page.status>
                        </div>
                    </div>
                    <div class="card-bsody p-0">
                        <table class="table table-strsiped table-vcenter mb-0">
                            <tr>
                                <td><strong>Data de Cadastro:</strong></td>
                                <td class="text-end">{{ $student->created_at->format('d/m/Y') }}</td>
                            </tr>
                            <tr>
                                <td><strong>Telefone:</strong></td>
                                <td class="text-end">{{ $student->user->phone1 }}</td>
                            </tr>
                            <tr>
                                <td><strong>Email</strong></td>
                                <td class="text-end">{{ $student->user->email }}</td>
                            </tr>





                        </table>
                    </div>
                    <div class="card-body">

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('student') }}" class="btn btn-link me-2" wire:navigate>Voltar</a>
                            <div class="dropdown">
                                <a href="#" class="btn dropdown-toggle" data-bs-toggle="dropdown">Ações</a>
                                <div class="dropdown-menu">
                                    <span class="dropdown-header">Dropdown header</span>
                                    <a class="dropdown-item" wire:click='block' wire:model='active' href="#">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="icon dropdown-item-icon icon-tabler icon-tabler-settings" width="24"
                                            height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path
                                                d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065z">
                                            </path>
                                            <path d="M12 12m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0"></path>
                                        </svg>
                                        Bloquear Acesso
                                    </a>
                                    <a class="dropdown-item" href="#">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="icon dropdown-item-icon icon-tabler icon-tabler-pencil" width="24"
                                            height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M4 20h4l10.5 -10.5a1.5 1.5 0 0 0 -4 -4l-10.5 10.5v4"></path>
                                            <path d="M13.5 6.5l4 4"></path>
                                        </svg>
                                        Excluir
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </x-slot:left>
        <x-slot:right>
            <div class="card flex-fill">
                <div class="card-header">
                    <ul class="nav nav-tabs card-header-tabs nasv-fill" data-bs-toggle="tabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a href="#tabs-home-7" class="nav-link active" data-bs-toggle="tab" aria-selected="true"
                                role="tab">
                                Histórico de Aulas
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a href="#tabs-profile-7" class="nav-link" data-bs-toggle="tab" aria-selected="false"
                                role="tab" tabindex="-1">
                                <!-- Download SVG icon from http://tabler.io/icons/icon/user -->
                                Dados Cadastrais
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a href="#tabs-activity-7" class="nav-link" data-bs-toggle="tab" aria-selected="false"
                                role="tab" tabindex="-1">
                                <!-- Download SVG icon from http://tabler.io/icons/icon/activity -->
                                Mensalidades
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane active show" id="tabs-home-7" role="tabpanel">
                            <x-table.table :search="false">
                                <thead>
                                    <tr>
                                        <th style="cursor:pointer" wire:click="sortBy('datetime')">Dia</th>
                                        <th style="cursor:pointer" wire:click="sortBy('datetime')">Horário</th>
                                        <th style="cursor:pointer" wire:click="sortBy('type')">Tipo</th>
                                        <th style="cursor:pointer" wire:click="sortBy('instructor_id')">Instrutor</th>
                                        <th style="cursor:pointer" wire:click="sortBy('status')">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($classes as $date => $class)
                                    <tr>
                                        <td scope="row">
                                            {{ $class->datetime->format('d/m/y') }} / 
                                            {{ ucfirst($class->datetime->isoFormat('ddd')) }}
                                        </td>
                                        <td>
                                            {{ $class->datetime->format('H:i') }}
                                        </td>
                                        <td>
                                            {{ $class->type->label() }}
                                        </td>
                                        <td>
                                            <x-page.user-avatar size="xs" :user="$class->instructor->user">
                                                <span class="small">
                                                    {{ $class->instructor->user->shortName }}
                                                </span>
                                            </x-page.user-avatar>
                                        </td>
                                        <td>
                                            <x-page.badge icon="{{ $class->status->icon() }}" color="{{ $class->status->color() }}">
                                                {{ $class->status->label() }}
                                            </x-page.badge>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </x-table.table>
                            <div class="mx-3">
                                {{$classes->links()}}
                            </div>
                        </div>
                        <div class="tab-pane" id="tabs-profile-7" role="tabpanel">
                            <livewire:student.student-form :modal="false" :student="$student" />
                        </div>
                        <div class="tab-pane" id="tabs-activity-7" role="tabpanel">
                            <h4>Activity tab</h4>
                            <div>
                                Donec ac vitae diam amet vel leo egestas consequat rhoncus in luctus amet, facilisi
                                sit mauris accumsan nibh habitant senectus
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </x-slot:right>
    </x-page.page-show>
</div>
