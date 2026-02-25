<div>
    <livewire:student.student-form />

    @section('title')
    Detalhes do Aluno
    @endsection

    <x-page.page-header>
        <h2 class="page-title">
            <x-icons.users />
            Detalhes do Aluno
        </h2>
    </x-page.page-header>

    <x-page.page-show>
        <x-slot:left>
            <div class="card flex-fill">
                <div>
                    <div class="card-body p-4 text-center">
                        <a href="#" wire:click="$dispatch('show-upload-avatar')">
                            <x-page.avatar size="xl" :user="$student->user" />
                        </a>
                        <h3 class="m-0 mb-1"><a href="#">{{ $student->user->name }}</a></h3>
                        <div class="mt-3">
                            <x-page.status color="{{ ($student->hasRegistration) ? 'green' : 'secondary' }}">
                                @if($student->hasRegistration)
                                Ativo
                                @else
                                Sem Matrícula
                                @endif
                            </x-page.status>
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
                            <livewire:avatar-uploader :user="$student->user" />
                        </table>
                    </div>
                    <div class="card-body">

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('student') }}" class="btn btn-link me-2" wire:navigate>Voltar</a>
                            <div class="dropdown">
                                <a href="#" class="btn dropdown-toggle" data-bs-toggle="dropdown">Ações</a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" wire:click='block' wire:model='active' href="#">
                                        <x-icons.block class="dropdown-item-icon" />
                                        Bloquear Acesso
                                    </a>
                                    <a class="dropdown-item" href="#">
                                        <x-icons.trash class="dropdown-item-icon" />
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
                            <a href="#tabs-home-7" wire:click.prevent="tabs('tabs-home-7')"
                                class="nav-link {{ $tab === 'tabs-home-7' ? 'active' : '' }}" data-bs-toggle="tab"
                                aria-selected="true" role="tab">
                                Histórico de Aulas
                            </a>
                        </li>

                        <li class="nav-item" role="presentation">
                            <a href="#tabs-activity-7" wire:click.prevent="tabs('tabs-activity-7')"
                                class="nav-link {{ $tab === 'tabs-activity-7' ? 'active' : '' }}" data-bs-toggle="tab"
                                aria-selected="false" role="tab" tabindex="-1">
                                <!-- Download SVG icon from http://tabler.io/icons/icon/activity -->
                                Financeiro
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a href="#tabs-profile-7" wire:click.prevent="tabs('tabs-profile-7')"
                                class="nav-link {{ $tab === 'tabs-profile-7' ? 'active' : '' }}" data-bs-toggle="tab"
                                aria-selected="false" role="tab" tabindex="-1">
                                <!-- Download SVG icon from http://tabler.io/icons/icon/user -->
                                Dados Cadastrais
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane {{ $tab === 'tabs-home-7' ? 'active show' : '' }}" id="tabs-home-7"
                            role="tabpanel">
                            <x-table.table :search="false">
                                <thead>
                                    <tr>
                                        <th style="cursor:pointer" wire:click="sortBy('datetime')">Dia</th>
                                        <th style="cursor:pointer" wire:click="sortBy('datetime')">Horário</th>
                                        <th style="cursor:pointer" wire:click="sortBy('modality.name')">Modalidade</th>
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
                                            {{ $class->modality->name }}
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
                                            <x-page.badge icon="{{ $class->status->icon() }}"
                                                color="{{ $class->status->color() }}">
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
                        <div class="tab-pane {{ $tab === 'tabs-profile-7' ? 'active show' : '' }}" id="tabs-profile-7"
                            role="tabpanel">
                            <livewire:student.student-form :modal="false" :student="$student" />
                        </div>
                        <div class="tab-pane {{ $tab === 'tabs-activity-7' ? 'active show' : '' }}" id="tabs-activity-7"
                            role="tabpanel">

                            <div>
                                <x-table.table :search="false">
                                    <thead>
                                        <tr>
                                            <th style="cursor:pointer" wire:click="sortBy('datetime')">Vencto</th>
                                            <th style="cursor:pointer" wire:click="sortBy('datetime')">Categoria</th>
                                            <th style="cursor:pointer" wire:click="sortBy('datetime')">Descrição</th>
                                            <th style="cursor:pointer" wire:click="sortBy('datetime')">Valor</th>
                                            <th style="cursor:pointer" wire:click="sortBy('modality.name')">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($transactions as $k => $item)
                                        <tr>
                                            <td scope="row">
                                                {{ $item->date->format('d/m/y') }}
                                            </td>
                                            <td>
                                                {{ $item->category->name }}
                                            </td>
                                            <td>
                                                {{ $item->description }}
                                            </td>

                                            <td>
                                                {{ $item->amount }}
                                            </td>
                                            <td>

                                                <x-page.badge color="{{ $item->currentStatus->color }}">
                                                    {{ $item->currentStatus->label }}
                                                </x-page.badge>
                                            </td>

                                        </tr>
                                        @endforeach
                                    </tbody>
                                </x-table.table>
                                <div class="mx-3">
                                    {{$transactions->links()}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </x-slot:right>
    </x-page.page-show>
</div>