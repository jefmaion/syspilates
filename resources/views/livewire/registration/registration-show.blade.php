<div wire:key="registration-show-{{ $registration->id }}">

    @section('title')
    Detalhes da Matrícula
    @endsection
    <x-page.page-header>
        <h2 class="page-title">
            <x-icons.users />
            Detalhes da Matrícula
        </h2>
    </x-page.page-header>

    <livewire:registration.actions.cancel-registration :registration="$registration" />

    <x-page.page-body>


        <div class="row">
            <div class="col-3 d-flex flex-column">
                <div class="card mb-3">
                    <div class="card-header card-header-lisght">
                        <h3 class="card-title">Informações</h3>
                    </div>
                    <div>
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <span class="avatar avatar-xl rounded-circle me-2">{{
                                    $registration->student->user->initials }}</span>
                                <div class="flex-fill align-items-top">
                                    <h3 class=""><strong>{{ $registration->student->user->name }}</strong></h3>
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
                    </div>
                    <div class="card-footer">
                        <div class="d-flex">
                            <a href="{{ route('registration') }}" wire:navigate class="btn btn-link">Voltar</a>

                            <div class="dropdown ms-auto">
                                <a href="#" class="btn dropdown-toggle btn-primary" data-bs-toggle="dropdown">Ações</a>
                                <div class="dropdown-menu">
                                    <span class="dropdown-header">Dropdown header</span>
                                    <a class="dropdown-item" wire:click="$dispatch('cancel-registration')" href="#">
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
                                        Cancelar Matrícula
                                    </a>
                                    <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                        data-bs-target="#modal-classes">
                                        <form wire:submit='changeClassDays'>
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="icon dropdown-item-icon icon-tabler icon-tabler-pencil"
                                                width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                                stroke="currentColor" fill="none" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M4 20h4l10.5 -10.5a1.5 1.5 0 0 0 -4 -4l-10.5 10.5v4"></path>
                                                <path d="M13.5 6.5l4 4"></path>
                                            </svg>
                                            Alterar Dia de Aula
                                        </form>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header card-header-lisght">
                        <h3 class="card-title">Matrícula Atual</h3>
                    </div>

                    <div class="card-body">
                        <table class="table">

                            <tbody>
                                <tr>
                                    <td scope="row"><strong>Plano:</strong> </td>
                                    <td class="text-end">{{$registration->planDescription }}</td>
                                </tr>

                                <tr>
                                    <td scope="row"><strong>Início:</strong></td>
                                    <td class="text-end">{{ $registration->start->format('d/m/Y') }}</td>
                                </tr>

                                <tr>
                                    <td scope="row"><strong>Vencimento:</strong></td>
                                    <td class="text-end">Dia {{ $registration->deadline }}</td>
                                </tr>

                                <tr>
                                    <td scope="row"><strong>Aulas:</strong></td>
                                    <td class="text-end">
                                        @foreach($registration->schedule as $sch)
                                        <div>{{ $sch->weekday }} às {{ $sch->time }}</div>
                                        @endforeach
                                    </td>
                                </tr>

                                <tr>
                                    <td scope="row"><strong>Status:</strong></td>
                                    <td class="text-end"><x-page.status color="{{ $registration->status->color() }}">{{
                                                        $registration->status->label()
                                                        }}
                                                    </x-page.status></td>
                                </tr>

                                {{-- <tr>
                                    <td scope="row"><strong>Início:</strong> 20/01/2025</td>
                                </tr>
                                <tr>
                                    <td scope="row"><strong>Vencimento:</strong> 10</td>
                                </tr>
                                <tr>
                                    <td scope="row"><strong>Status:</strong> </td> --}}
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-9">


                <div class="card mb-3">
                    <div class="card-header card-header-lisght">
                        <h3 class="card-title">Financeiro</h3>
                    </div>

                    <div class="card-body">

                        <p><strong>Próximo Vencimento:</strong> 10/04/2026</p>

                    </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Data</th>
                                <th>Descrição</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>01/10/2025</td>
                                <td>Mensalidade 1</td>
                                <td>
                                    <span class="badge bg-green-lt">Agendado</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                </div>


                <div class="card">
                    <div class="card-header">
                        <ul class="nav nav-tabs card-header-tabs" data-bs-toggle="tabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a href="#tabs-home-8" class="nav-link active" data-bs-toggle="tab" aria-selected="true"
                                    role="tab">Próximas Aulas</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a href="#tabs-profile-8" class="nav-link" data-bs-toggle="tab" aria-selected="false"
                                    role="tab" tabindex="-1">Aulas Realizadas</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a href="#tabs-activity-8" class="nav-link" data-bs-toggle="tab" aria-selected="false"
                                    role="tab" tabindex="-1">Faltas</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane fade active show" id="tabs-home-8" role="tabpanel">
                                <div>
                                    <x-table.table>
                                        <thead>
                                            <tr>
                                                <th scope="col">Dia</th>
                                                <th scope="col">Horário</th>
                                                <th scope="col">Instrutor</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($classes as $date => $class)

                                            <tr class="">
                                                <td scope="row">{{ $class['date']->format('d/m/Y') }}</td>
                                                <td>{{ $class['time'] }}</td>
                                                <td>
                                                    <x-page.user-avatar size="xs" :user="$class['instructor']->user">
                                                        <span class="small">
                                                            {{ $class['instructor']->user->shortName }}
                                                        </span>
                                                    </x-page.user-avatar>
                                                </td>
                                                <td>
                                                    <x-page.status color="{{ $class['status']->color() }}">{{
                                                        $class['status']->label()
                                                        }}
                                                    </x-page.status>

                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </x-table.table>
                                    {{ $classes->links() }}
                                </div>
                            </div>
                            <div class="tab-pane fade" id="tabs-profile-8" role="tabpanel">
                                <h4>Profile tab</h4>
                                <div>
                                    Fringilla egestas nunc quis tellus diam rhoncus ultricies tristique enim at diam,
                                    sem nunc amet, pellentesque id egestas velit sed
                                </div>
                            </div>
                            <div class="tab-pane fade" id="tabs-activity-8" role="tabpanel">
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

            {{-- <div class="col d-flex">
                <div class="card flex-fill">
                    <div class="card-header card-header-lisght">
                        <h3 class="card-title">Reposições</h3>
                    </div>

                    <div class="card-body">
                        <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#modal-classes">
                            <form wire:submit='changeClassDays'>
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="icon dropdown-item-icon icon-tabler icon-tabler-pencil" width="24"
                                    height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M4 20h4l10.5 -10.5a1.5 1.5 0 0 0 -4 -4l-10.5 10.5v4"></path>
                                    <path d="M13.5 6.5l4 4"></path>
                                </svg>
                                Alterar Dia de Aula
                            </form>
                        </a>
                        <table class="table">

                            <tbody>
                                <tr>
                                    <td scope="row"><strong>Plano:</strong> Trimestral</td>
                                </tr>
                                <tr>
                                    <td scope="row"><strong>Início:</strong> 20/01/2025</td>
                                </tr>
                                <tr>
                                    <td scope="row"><strong>Vencimento:</strong> 10</td>
                                </tr>
                                <tr>
                                    <td scope="row"><strong>Status:</strong> Trimestral</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div> --}}
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
                                @for($i=0; $i<=$form->class_per_week;$i++)
                                    <tr class="">
                                        <td scope="row">
                                            <x-form.select-weekday name="form.schedule.{{ $i }}.weekday"
                                                wire:model='form.schedule.{{ $i }}.weekday' />
                                        </td>
                                        <td>
                                            <x-form.select-time type="time" name="form.schedule.{{ $i }}.time"
                                                wire:model='form.schedule.{{ $i }}.time' />
                                        </td>
                                        <td>
                                            <x-form.select-instructor name="form.schedule.{{ $i }}.instructor_id"
                                                wire:model='form.schedule.{{ $i }}.instructor_id' />
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
