<div>
    <livewire:instructor.instructor-form />
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
            <div class="col-3 d-flex">
                <div class="card flex-fill">
                    <div class="card-body p-4 text-center">
                        <span class="avatar avatar-xl mb-3">
                            {{ $instructor->user->initials }}
                        </span>
                        <h3 class="m-0 mb-1"><a href="#">{{ $instructor->user->name }}</a></h3>
                        <div class="text-secondary">UI Designer</div>
                        {{-- <div class="mt-3">
                            <span class="badge bg-purple-lt">Owner</span>
                        </div> --}}
                        <div class="mt-3 text-left">
                            <div class="d-flex justify-content-between align-items-center border-top py-3">
                                <span><strong>Data de Cadastro</strong></span>
                                <span>{{ $instructor->created_at->format('d/m/Y') }}</span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center border-top py-3">
                                <span><strong>Status</strong></span>
                                <span><span class="badge bg-green-lt">Ativo</span></span>
                            </div>

                            <div class="d-flex justify-content-between align-items-center border-top py-3">
                                <span><strong>Aulas</strong></span>
                                <span>{{ rand() }}</span>
                            </div>

                            <div class="d-flex justify-content-between align-items-center border-top py-3">
                                <span><strong>Presenças</strong></span>
                                <span>{{ rand() }}</span>
                            </div>

                            <div class="d-flex justify-content-between align-items-center border-top py-3">
                                <span><strong>Faltas</strong></span>
                                <span>{{ rand() }}</span>
                            </div>

                            <div class="d-flex justify-content-between align-items-center border-top py-3">
                                <span><strong>Reposições</strong></span>
                                <span>{{ rand() }}</span>
                            </div>

                        </div>
                    </div>
                    <div class="d-flex">
                        <a href="#" class="card-btn">
                            <!-- Download SVG icon from http://tabler.io/icons/icon/mail -->
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="icon me-2 text-muted icon-3">
                                <path
                                    d="M3 7a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v10a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-10z">
                                </path>
                                <path d="M3 7l9 6l9 -6"></path>
                            </svg>
                            Email
                        </a>
                        <a href="#" class="card-btn">
                            <!-- Download SVG icon from http://tabler.io/icons/icon/phone -->
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="icon me-2 text-muted icon-3">
                                <path
                                    d="M5 4h4l2 5l-2.5 1.5a11 11 0 0 0 5 5l1.5 -2.5l5 2v4a2 2 0 0 1 -2 2a16 16 0 0 1 -15 -15a2 2 0 0 1 2 -2">
                                </path>
                            </svg>
                            Call
                        </a>
                    </div>
                </div>
            </div>
            <div class="col d-flex">
                <div class="card flex-fill">
                    <div class="card-header">
                        <ul class="nav nav-tabs card-header-tabs nasv-fill" data-bs-toggle="tabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a href="#tabs-home-7" wire:click.prevent="tabs('tabs-home-7')"
                                    class="nav-link {{ $tab === 'tabs-home-7' ? 'active' : '' }}" data-bs-toggle="tab"
                                    aria-selected="true" role="tab">
                                    <!-- Download SVG icon from http://tabler.io/icons/icon/home -->
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="icon me-2 icon-2">
                                        <path d="M5 12l-2 0l9 -9l9 9l-2 0"></path>
                                        <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7"></path>
                                        <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6"></path>
                                    </svg>Aulas
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a href="#tabs-profile-7" wire:click.prevent="tabs('tabs-profile-7')"
                                    class="nav-link {{ $tab === 'tabs-profile-7' ? 'active' : '' }}"
                                    data-bs-toggle="tab" aria-selected="false" role="tab" tabindex="-1">
                                    <!-- Download SVG icon from http://tabler.io/icons/icon/user -->
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="icon me-2 icon-2">
                                        <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"></path>
                                        <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                                    </svg>Modalidades
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a href="#tabs-activity-7" wire:click.prevent="tabs('tabs-activity-7')"
                                    class="nav-link {{ $tab === 'tabs-activity-7' ? 'active' : '' }}"
                                    data-bs-toggle="tab" aria-selected="false" role="tab" tabindex="-1">
                                    <!-- Download SVG icon from http://tabler.io/icons/icon/activity -->
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="icon me-2 icon-2">
                                        <path d="M3 12h4l3 8l4 -16l3 8h4"></path>
                                    </svg>Activity
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane {{ $tab === 'tabs-home-7' ? 'active show' : '' }} " id="tabs-home-7"
                                role="tabpanel">
                                <h4>Home tab</h4>



                            </div>
                            <div class="tab-pane {{ $tab === 'tabs-profile-7' ? 'active show' : '' }}"
                                id="tabs-profile-7" role="tabpanel">
                                <h4>Modalidades</h4>
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
                                                <a href="#"
                                                    wire:click="$dispatch('edit-modality', {modalityId: {{ $modality->id }}})">Editar</a>
                                                <a href="#"
                                                    wire:click="$dispatch('remove-modality', {modalityId: {{ $modality->id }}})">Excluir</a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </x-table.table>
                                </div>
                            </div>
                            <div class="tab-pane {{ $tab === 'tabs-activity-7' ? 'active show' : '' }}"
                                id="tabs-activity-7" role="tabpanel">
                                <h4>Activity tab</h4>
                                <div>
                                    Donec ac vitae diam amet vel leo egestas consequat rhoncus in luctus amet, facilisi
                                    sit mauris accumsan nibh habitant senectus
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <a href="{{ route('instructor') }}" class="me-2" wire:navigate>Voltar</a>
    </x-page.page-body>
</div>