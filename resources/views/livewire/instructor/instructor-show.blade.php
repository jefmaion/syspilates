<div>
    <livewire:instructor.instructor-modality-form :instructor="$instructor" />
    @section('title')
    Detalhes do Professor
    @endsection
    <x-page.page-header>

        <h2 class="page-title">
            <x-icons.users />
            Detalhes do Professor
        </h2>
    </x-page.page-header>



    <x-page.page-show>

        <x-slot:left>
            <livewire:avatar-uploader :user="$instructor->user" />
            <div class="card d-flex flex-fill">
                <div>
                    <div class="card-body p-4 text-center">
                        <a href="#" wire:click="$dispatch('show-upload-avatar')">
                            <x-page.avatar size="xl" :user="$instructor->user" />
                        </a>
                        <h3 class="m-0 mb-1"><a href="#">{{ $instructor->user->name }}</a></h3>
                        <div class="text-secondary">{{ $instructor->profession }}</div>
                        <div class="text-secondary">{{ $instructor->document }}</div>
                        <div class="mt-3">
                            <x-page.status color="{{ $instructor->user->active ? 'green' : 'secondary' }}">
                                {{ $instructor->user->status }}</x-page.status>
                        </div>
                    </div>

                    <div class="card-bsody p-0">
                        <table class="table table-strsiped table-vcenter mb-0">
                            <tr>
                                <td><strong>Data de Cadastro:</strong></td>
                                <td class="text-end">{{ $instructor->created_at->format('d/m/Y') }}</td>
                            </tr>
                            <tr>
                                <td><strong>Telefone:</strong></td>
                                <td class="text-end">{{ $instructor->user->phone1 }}</td>
                            </tr>
                            <tr>
                                <td><strong>Email</strong></td>
                                <td class="text-end">{{ $instructor->user->email }}</td>
                            </tr>





                        </table>
                    </div>

                    <div class="card-body">

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('instructor') }}" class="btn btn-link me-2" wire:navigate>Voltar</a>
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
                            <a href="#tab-instructor-modality" wire:click.prevent="tabs('tab-instructor-modality')"
                                class="nav-link {{ $tab === 'tab-instructor-modality' ? 'active' : '' }}"
                                data-bs-toggle="tab" aria-selected="false" role="tab" tabindex="-1">
                                Modalidades
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a href="#tab-class-history" wire:click.prevent="tabs('tab-class-history')"
                                class="nav-link {{ $tab === 'tab-class-history' ? 'active' : '' }}" data-bs-toggle="tab"
                                aria-selected="true" role="tab">
                                Histórico de Aulas
                            </a>
                        </li>

                        <li class="nav-item" role="presentation">
                            <a href="#tab-payments" wire:click.prevent="tabs('tab-payments')"
                                class="nav-link {{ $tab === 'tab-payments' ? 'active' : '' }}" data-bs-toggle="tab"
                                aria-selected="false" role="tab" tabindex="-1">
                                Financeiro
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a href="#tab-userdata" wire:click.prevent="tabs('tab-userdata')"
                                class="nav-link {{ $tab === 'tab-userdata' ? 'active' : '' }}" data-bs-toggle="tab"
                                aria-selected="false" role="tab" tabindex="-1">
                                Dados Cadastrais
                            </a>
                        </li>

                        <li class="nav-item" role="presentation">
                            <a href="#tab-access" wire:click.prevent="tabs('tab-access')"
                                class="nav-link {{ $tab === 'tab-access' ? 'active' : '' }}" data-bs-toggle="tab"
                                aria-selected="false" role="tab" tabindex="-1">
                                Acesso ao sistema
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="csard-body">
                    <div class="tab-content">
                        <div class="tab-pane {{ $tab === 'tab-class-history' ? 'active show' : '' }} "
                            id="tab-class-history" role="tabpanel">

                            <div class="card-body">
                                <h4>Home tab</h4>
                            </div>
                            <x-table.table :search="false">
                                <thead>
                                    <tr>
                                        <th>Data</th>
                                        <th>Dia</th>
                                        <th>Hora</th>
                                        <th>Modalidade</th>
                                        <th>Tipo de Aula</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                @foreach ($classes as $class)
                                <tr>
                                    <td>{{ $class->datetime->format('d/m/y') }}</td>
                                    <td>{{ ucfirst($class->datetime->isoFormat('dddd')) }}</td>
                                    <td>{{ $class->datetime->format('H:i') }}</td>
                                    <td>{{ $class->modality->name }}</td>
                                    <td>{{ $class->type->label() }}</td>
                                    <td>
                                        <x-page.badge color="{{ $class->status->color() }}">{{ $class->status->label()
                                            }}</x-page.badge>
                                    </td>
                                </tr>
                                @endforeach
                            </x-table.table>
                            <div class="card-body">{{ $classes->links() }}</div>
                        </div>
                        <div class="tab-pane {{ $tab === 'tab-instructor-modality' ? 'active show' : '' }}"
                            id="tab-instructor-modality" role="tabpanel">
                            <div>

                                <div class="card-body">
                                    <a href="#" wire:click="$dispatch('attach-modality')" wire:ignore.self
                                        class="btn btn-primary   my-3">
                                        Adicionar modalidade
                                    </a>
                                </div>


                                <x-table.table :search="false">
                                    <thead>
                                        <tr>
                                            <th>Modalidade</th>
                                            <th>Forma de Comissão</th>
                                            <th>Valor da Comissão</th>
                                            <th>Calcula na FJ?</th>
                                            <th>Ações</th>
                                        </tr>
                                    </thead>
                                    @foreach ($instructor->modalities as $modality)
                                    <tr>
                                        <td>{{ $modality->name }}</td>
                                        <td>{{ $modality->pivot->commission_type == 'fixed'
                                            ? 'Fixo'
                                            : 'Percentual
                                            (%)' }}</td>
                                        <td>{{ currency($modality->pivot->commission_value, prepend: null) }}</td>
                                        <td>{{ $modality->pivot->calculate_on_justified_absence ? 'Sim' : 'Não' }}
                                        </td>
                                        <td>
                                            <x-buttons.button-link href="#"
                                                wire:click="$dispatch('edit-modality', {modalityId: {{ $modality->id }}})"
                                                class="btn-warning btn-sm">
                                                <x-icons.edit class="" /><span class="d-none d-sm-inline">Editar</span>
                                            </x-buttons.button-link>

                                            <x-buttons.button-link
                                                wire:click="$dispatch('remove-modality', {modalityId: {{ $modality->id }}})"
                                                class="btn-danger bgst btn-sm">
                                                <x-icons.trash /> <span class="d-none d-sm-inline">Remover</span>
                                            </x-buttons.button-link>
                                        </td>

                                    </tr>
                                    @endforeach
                                </x-table.table>
                            </div>
                        </div>
                        <div class="tab-pane {{ $tab === 'tab-userdata' ? 'active show' : '' }}" id="tab-userdata"
                            role="tabpanel">
                            <div>
                                <div class="card-body">
                                    <livewire:instructor.instructor-form :modal="false" :instructor="$instructor" />
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane {{ $tab === 'tab-access' ? 'active show' : '' }}" id="tab-access"
                            role="tabpanel">
                            <div class="card-body mt-3">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="divide-y">
                                            <div>
                                                <label class="row">
                                                    <span class="col">Permitir acesso ao sistema</span>
                                                    <span class="col-auto">
                                                        <label class="form-check form-check-single form-switch">
                                                            <input class="form-check-input" type="checkbox"
                                                                wire:click='block' wire:model='active' {{
                                                                $instructor->user->active ? 'checked' : '' }}>
                                                        </label>
                                                    </span>
                                                </label>
                                            </div>

                                            <div>
                                                <button type="button" class="btn btn-primary">
                                                    Resetar e reenviar senha de acesso
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane {{ $tab === 'tab-payments' ? 'active show' : '' }} " id="tab-payments"
                            role="tabpanel">


                            <x-table.table :search="false">
                                <thead>
                                    <tr>
                                        <th style="cursor:pointer" wire:click="sortBy('datetime')">Vencto</th>
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
                            <div class="card-body">{{$transactions->links()}}</div>
                        </div>
                    </div>
                </div>
            </div>
        </x-slot:right>

    </x-page.page-show>


</div>