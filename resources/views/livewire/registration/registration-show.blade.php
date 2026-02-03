<div wire:key="registration-show-{{ $registration->id }}">

    @section('title')
    Detalhes da Matrícula
    @endsection
    <x-page.page-header>
        <h2 class="page-title">
            <x-icons.users />
            Detalhes da Matrícula
        </h2>
        <x-slot:actions>
            <a class="btn btn-outline-secondary" wire:click="$dispatch('cancel-registration')">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon dropdown-item-icon icon-tabler icon-tabler-settings"
                    width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path
                        d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065z">
                    </path>
                    <path d="M12 12m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0"></path>
                </svg>
                Cancelar Matrícula</a>
            <a class="btn btn-blue" data-bs-toggle="modal" data-bs-target="#modal-classes">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon dropdown-item-icon icon-tabler icon-tabler-pencil"
                    width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M4 20h4l10.5 -10.5a1.5 1.5 0 0 0 -4 -4l-10.5 10.5v4"></path>
                    <path d="M13.5 6.5l4 4"></path>
                </svg>
                Alterar Dia de aulas</a>
        </x-slot:actions>
    </x-page.page-header>

    <livewire:registration.actions.cancel-registration :registration="$registration" />

    <x-page.page-body>

        <livewire:registration.update-class />
        <livewire:calendar.form-register-class />
        <livewire:transaction.register-transaction />


        @if ($registration->hasUnpaidTransactions)
        <div class="alert alert-warning " role="alert">
            <div class="alert-icon">
            <!-- Download SVG icon from http://tabler.io/icons/icon/alert-triangle -->
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon-tada icon alert-icon icon-2">
                <path d="M12 9v4"></path>
                <path d="M10.363 3.591l-8.106 13.534a1.914 1.914 0 0 0 1.636 2.871h16.214a1.914 1.914 0 0 0 1.636 -2.87l-8.106 -13.536a1.914 1.914 0 0 0 -3.274 0z"></path>
                <path d="M12 16h.01"></path>
            </svg>
            </div>
             Existem mensalidades em aberto!
        </div>
        @endif

        <div class="row ">
            <div class="col-12 col-sm-3 col-md-3 col-lg-3 col-xl-3 d-flex flex-column">

                <div class="card mb-3">
                    <div class="card-header">
                        <h3 class="card-title">Informações</h3>
                    </div>
                    <div>
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <x-page.avatar class="rounded-circle" size="lg" :user="$registration->student->user" />
                                <div class="flex-fill align-items-top">
                                    <h3 class=""><strong><a href="{{ route('student.show', $registration->student) }}">{{ $registration->student->user->name }}</a></strong></h3>
                                    <div class="text-secondary">
                                        <a href="#" class="text-reset">lmiona@livejournal.com</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="px-4 py-2">
                            <div class="mb-2">
                                <x-icons.info /> Idade: {{ $registration->student->user->age }}
                            </div>

                            <div class="mb-2">
                                <x-icons.info /> Tel.: {{ $registration->student->user->phone1 }}
                            </div>
                            <div class="mb-2">
                                <x-icons.info /> Objetivo: {{ $registration->student->objective }}
                            </div>
                        </div>

                        <div class="card-body">
                            <a href="{{ route('registration') }}" wire:navigate class="btn btn-link">Voltar</a>
                        </div>
                    </div>

                </div>

                <div class="card flex-fill">
                    <div class="card-header">
                        <h3 class="card-title">Plano</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <p>Status: <x-page.badge color="{{ $registration->status->color() }}">{{
                                        $registration->status->label() }}</x-page.badge>
                                </p>
                                <p>Período: <strong>{{$registration->planDescription }}</strong></p>
                                <p>Modalidade: <strong>{{$registration->modality->name }}</strong></p>
                            </div>
                            <div class="col-12">
                                <p>Início: <strong>{{ $registration->start->format('d/m/Y') }}</strong></p>
                                <p>Fim: <strong>{{ $registration->end->format('d/m/Y') }}</strong></p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">

                <div class="card">
                    <div class="card-header">
                        <ul class="nav nav-tabs card-header-tabs" data-bs-toggle="tabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a href="#tab-scheduled" wire:click.prevent="tabs('tab-scheduled')" class="nav-link {{ $tab === 'tab-scheduled' ? 'active' : '' }}" data-bs-toggle="tab" aria-selected="false" role="tab" tabindex="-1">Aulas</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a href="#tab-makeup"  wire:click.prevent="tabs('tab-makeup')" class="nav-link {{ $tab === 'tab-makeup' ? 'active' : '' }}" data-bs-toggle="tab" aria-selected="true" role="tab">Reposições</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a href="#tab-evolution" wire:click.prevent="tabs('tab-evolution')" class="nav-link {{ $tab === 'tab-evolution' ? 'active' : '' }}" data-bs-toggle="tab" aria-selected="true" role="tab">Evoluções</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a href="#tab-transactions" wire:click.prevent="tabs('tab-transactions')" class="nav-link {{ $tab === 'tab-transactions' ? 'active' : '' }}" data-bs-toggle="tab" aria-selected="true" role="tab">Mensalidades</a>
                            </li>
                        </ul>
                    </div>
                    <div class="scard-body">
                        <div class="tab-content">
                            <div class="tab-pane fade {{ $tab === 'tab-scheduled' ? 'active show' : '' }} " id="tab-scheduled" role="tabpanel">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <div class="card">
                                                <div class="card-status-start bg-primary"></div>
                                                <div class="card-body">
                                                    <div class="d-flex align-items-center">
                                                        <div class="subheader">AGENDADAS</div>
                                                    </div>
                                                    <div class="h1">{{ $scheduleds }}</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="card">
                                                <div class="card-status-start bg-success"></div>
                                                <div class="card-body">
                                                    <div class="d-flex align-items-center">
                                                        <div class="subheader">PRESENÇAS</div>
                                                    </div>
                                                    <div class="h1">{{ $presences }}</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="card">
                                                <div class="card-status-start bg-danger"></div>
                                                <div class="card-body">
                                                    <div class="d-flex align-items-center">
                                                        <div class="subheader">FALTAS</div>
                                                    </div>
                                                    <div class="h1">{{ $absenses }}</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="card">
                                                <div class="card-status-start bg-warning"></div>
                                                <div class="card-body">
                                                    <div class="d-flex align-items-center">
                                                        <div class="subheader">REPOSIÇÕES</div>
                                                    </div>
                                                    <div class="h1">{{ $countMakeups }}</div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                                @include('livewire.registration.parts.class-table')
                            </div>
                            <div class="tab-pane fade {{ $tab === 'tab-makeup' ? 'active show' : '' }}" id="tab-makeup" role="tabpanel">
                                <div class="card-body">
                                    <p><strong>Reposições à agendar</strong></p>
                                </div>
                                @if($markups->isEmpty())
                                    <div class="card-body"><p class="m-3">Nenhuma reposição encontrada.</p></div>
                                @else
                                    @include('livewire.registration.parts.makeup-table')
                                @endif
                            </div>
                            <div class="tab-pane fade {{ $tab === 'tab-evolution' ? 'active show' : '' }}" id="tab-evolution" role="tabpanel">
                            <div class="card-body">
                                    <p><strong>Linha do tempo</strong></p>
                                    @if($markups->isEmpty())
                                        <p class="m-3">Nenhuma evolução encontrada.</p>
                                    @else
                                        @include('livewire.registration.parts.evolution-timeline')
                                    @endif
                                </div>
                            </div>
                            <div class="tab-pane fade {{ $tab === 'tab-transactions' ? 'active show' : '' }}" id="tab-transactions" role="tabpanel">
                                <div class="card-body">
                                    <p><strong>Linha do tempo</strong></p>
                                    @if($transactions->isEmpty())
                                        <p class="m-3">Nenhuma evolução encontrada.</p>
                                    @else
                                        @include('livewire.registration.parts.transactions-table')
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="col d-flex flex-column">

                <div class="card mb-3">
                    <div class="card-header">
                        <h3 class="card-title">Mensalidade</h3>
                    </div>
                    <div class="card-body">
                        <p>Status: 
                            @if($registration->hasUnpaidTransactions)
                                <x-page.badge color="danger">Pendente</x-page.badge>
                            @else
                                <x-page.badge>Em Dia</x-page.badge>
                            @endif
                            
                        </p>
                        <p>Próximo Vencimento: <strong>{{ $registration->nextTransaction?->date->format('d/m/y') ?? '-' }}</strong></p>
                    </div>
                </div>

                <div class="card flex-fill">
                    <div class="card-header">
                        <p class="card-title">Reposições Em Aberto</p>
                    </div>
                    <div class="card-body">
                        @if($markups->isEmpty())
                        <p class="m-3">Nenhuma reposição encontrada.</p>
                        @else
                        <x-table.table :search="false" class="mb-3">
                            <thead>
                                <tr>
                                    <th scope="col">Falta</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($markups as $date => $class)
                                <tr>
                                    <td>{{ $class->origin->datetime->format('d/m/y') }} / {{
                                        ucfirst($class->origin->datetime->isoFormat('ddd')) }}
                                    </td>
                                    <td class="text-right">
                                        
                                        @if($class->status == 'active')
                                            <x-page.badge color="success">Ativo</x-page.badge>
                                        @endif

                                        @if($class->status == 'next_to_expire')
                                            <x-page.badge color="warning"> Expira em {{ $class->daysToExpire }} dia(s)</x-page.badge>
                                        @endif

                                        @if($class->status == 'expired')
                                            <x-page.badge color="secondary">Expirado</x-page.badge>
                                        @endif

                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </x-table.table>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <x-modal.modal size="modal-lg" id="modal-classes">
            <form wire:submit="changeClassDays">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title align-items-center" id="modalTitleId">
                            <x-icons.users /> Alterar Dias de Aulas
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="msdal-body">
                        <x-table.table :search="false">
                            <thead>
                                <tr>
                                    <th scope="col">Dia</th>
                                    <th scope="col">Horário</th>
                                    <th scope="col">Professor</th>
                                </tr>
                            </thead>
                            <tbody>
                                @for($i=0; $i<$form->class_per_week;$i++)
                                    <tr class="">
                                        <td scope="row">
                                            <x-form.select-weekday name="form.schedule.{{ $i }}.weekday" wire:model='form.schedule.{{ $i }}.weekday' />
                                        </td>
                                        <td>
                                            <x-form.select-time type="time" name="form.schedule.{{ $i }}.time" wire:model='form.schedule.{{ $i }}.time' />
                                        </td>
                                        <td>
                                            <x-form.select-instructor name="form.schedule.{{ $i }}.instructor_id" wire:model='form.schedule.{{ $i }}.instructor_id' />
                                        </td>
                                    </tr>
                                    @endfor
                            </tbody>
                        </x-table.table>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn  btn-outline-secondary" data-bs-dismiss="modal">
                            Fechar
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <span wire:loading.remove>Salvar</span>
                            <span wire:loading>
                                <span class="spinner-border spinner-border-sm"></span>
                                Salvando...
                            </span>
                        </button>
                    </div>
                </div>
            </form>
        </x-modal.modal>
    </x-page.page-body>

</div>