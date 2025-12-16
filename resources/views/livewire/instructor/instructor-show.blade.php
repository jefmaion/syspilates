<div>
    <livewire:instructor.instructor-modality-form :instructor="$instructor" />
    @section('title')
    Detalhes do Professor
    @endsection
    <x-page.page-header>
        <div class="page-pretitle">Overview</div>
        <h2 class="page-title">
            <x-icons.users />
            Detalhes do Professor
        </h2>

    </x-page.page-header>

    <x-page.page-body>
        <div class="row">
            <div class="col-12 col-md-3 d-flex flex-column">
                <div class="card flex-fill">
                    <div class="card-body p-4 text-center">
                        <span class="avatar avatar-xl mb-3">
                            {{ $instructor->user->initials }}
                        </span>
                        <h3 class="m-0 mb-1"><a href="#">{{ $instructor->user->name }}</a></h3>
                        <div class="text-secondary">{{ $instructor->profession }}</div>
                        {{-- <div class="mt-3">
                            <span class="badge bg-purple-lt">Owner</span>
                        </div> --}}
                        <div class="mt-3 text-left">
                            <div class="d-flex justify-content-between align-items-center border-top py-3">
                                <span><strong>Professor desde:</strong></span>
                                <span>{{ $instructor->created_at->format('d/m/Y') }}</span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center border-top py-3">
                                <span><strong>Status</strong></span>
                                <span><span class="badge bg-{{ $instructor->user->active ? 'green' : 'secondary' }}-lt">{{ $instructor->user->status }}</span></span>
                            </div>

                        </div>

                         <a href="{{ route('instructor') }}" class="me-2" wire:navigate>Voltar</a>
                    </div>
                    
                </div>
            </div>
            <div class="col-12 col-md-9 d-flex mt-3 mt-md-0">
                <div class="card flex-fill">
                    <div class="card-header">
                        <ul class="nav nav-tabs card-header-tabs nav-fill" data-bs-toggle="tabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a href="#tab-class-history" wire:click.prevent="tabs('tab-class-history')"
                                    class="nav-link {{ $tab === 'tab-class-history' ? 'active' : '' }}"
                                    data-bs-toggle="tab" aria-selected="true" role="tab">
                                    Histórico de Aulas
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a href="#tab-instructor-modality" wire:click.prevent="tabs('tab-instructor-modality')"
                                    class="nav-link {{ $tab === 'tab-instructor-modality' ? 'active' : '' }}"
                                    data-bs-toggle="tab" aria-selected="false" role="tab" tabindex="-1">
                                    Modalidades
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
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane {{ $tab === 'tab-class-history' ? 'active show' : '' }} "
                                id="tab-class-history" role="tabpanel">
                                <h4>Home tab</h4>



                            </div>
                            <div class="tab-pane {{ $tab === 'tab-instructor-modality' ? 'active show' : '' }}"
                                id="tab-instructor-modality" role="tabpanel">
                                <div>

                                    <a href="#" wire:click="$dispatch('attach-modality')" wire:ignore.self
                                        class="btn btn-primary   my-3">
                                        Adicionar modalidade
                                    </a>


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
                                        @foreach($instructor->modalities as $modality)
                                        <tr>
                                            <td>{{ $modality->name }}</td>
                                            <td>{{ ($modality->pivot->commission_type == 'fixed') ? 'Fixo' : 'Percentual
                                                (%)' }}</td>
                                            <td>{{ $modality->pivot->commission_value }}</td>
                                            <td>{{ ($modality->pivot->calculate_on_justified_absence) ? 'Sim' : 'Não' }}
                                            </td>
                                            <td>


                                                <x-buttons.button-link href="#"
                                                    wire:click="$dispatch('edit-modality', {modalityId: {{ $modality->id }}})"
                                                    class="btn-warning btn-sm">
                                                    <x-icons.edit class="" /><span
                                                        class="d-none d-sm-inline">Editar</span>
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
                                    <livewire:instructor.instructor-form :modal="false" :instructor="$instructor" />
                                </div>
                            </div>
                            <div class="tab-pane {{ $tab === 'tab-access' ? 'active show' : '' }}" id="tab-access"
                                role="tabpanel">
                                <div class="mb-3">
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="divide-y">
                                                <div>
                                                    <label class="row">
                                                        <span class="col">Permitir acesso ao sistema</span>
                                                        <span class="col-auto">
                                                            <label class="form-check form-check-single form-switch">
                                                                <input class="form-check-input" type="checkbox" wire:click='block' wire:model='active' {{ ($instructor->user->active) ? 'checked' : '' }} >
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
       
    </x-page.page-body>
</div>