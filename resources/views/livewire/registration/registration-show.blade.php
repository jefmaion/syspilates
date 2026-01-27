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

                        <div>
                            <a href="{{ route('registration') }}" wire:navigate class="btn btn-link">Voltar</a>
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
                                    <td scope="row"><strong>Status:</strong></td>
                                    <td class="text-end">
                                        <x-page.status color="{{ $registration->status->color() }}">{{
                                            $registration->status->label()
                                            }}
                                        </x-page.status>
                                    </td>
                                </tr>
                                <tr>
                                    <td scope="row"><strong>Plano:</strong> </td>
                                    <td class="text-end">{{$registration->planDescription }}</td>
                                </tr>

                                <tr>
                                    <td scope="row"><strong>Modalidade:</strong> </td>
                                    <td class="text-end">{{$registration->modality->name }}</td>
                                </tr>

                                <tr>
                                    <td scope="row"><strong>Período:</strong></td>
                                    <td class="text-end">{{ $registration->start->format('d/m/y') }} à {{
                                        $registration->end->format('d/m/y') }}</td>
                                </tr>

                                <tr>
                                    <td scope="row"><strong>Vencimento:</strong></td>
                                    <td class="text-end">Dia {{ $registration->deadline }}</td>
                                </tr>

                                <tr>
                                    <td scope="row"><strong>Aulas:</strong></td>
                                    <td class="text-end">
                                        @foreach($registration->schedule as $sch)
                                        <div>{{ $sch->weekday->short() }} às {{ $sch->time }}</div>
                                        @endforeach
                                    </td>
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

            <div class="col-6 d-flex flex-column">
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

                <div class="card flex-fill">
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
                                    <x-table.table :search="false">
                                        <thead>
                                            <tr>
                                                <th scope="col">Dia</th>
                                                <th scope="col">Horário</th>
                                                <th>Tipo</th>
                                                <th scope="col">Instrutor</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($scheduled as $date => $class)

                                            <tr class="">
                                                <td scope="row">{{ $class->datetime->format('d/m/Y') }}</td>
                                                <td>{{ $class->datetime->format('H:i') }}</td>
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
                                                    <x-page.status color="{{ $class->status->color() }}">{{
                                                        $class->status->label()
                                                        }}
                                                    </x-page.status>

                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </x-table.table>
                                    {{$scheduled->links()}}
                                </div>
                            </div>
                            <div class="tab-pane fade" id="tabs-profile-8" role="tabpanel">
                                <h4>Profile tab</h4>
                                <div>
                                    <x-table.table :search="false">
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
                                                <td scope="row">{{ $class->datetime->format('d/m/Y') }}</td>
                                                <td>{{ $class->datetime->format('H:i') }}</td>
                                                <td>
                                                    <x-page.user-avatar size="xs" :user="$class->instructor->user">
                                                        <span class="small">
                                                            {{ $class->instructor->user->shortName }}
                                                        </span>
                                                    </x-page.user-avatar>
                                                </td>
                                                <td>
                                                    <x-page.status color="{{ $class->status->color() }}">{{
                                                        $class->status->label()
                                                        }}
                                                    </x-page.status>

                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </x-table.table>
                                    {{$classes->links()}}
                                </div>
                            </div>
                            <div class="tab-pane fade" id="tabs-activity-8" role="tabpanel">
                                <h4>Activity tab</h4>
                                <div>
                                    Donec ac vitae diam amet vel leo egestas consequat rhoncus in luctus amet,
                                    facilisi
                                    sit mauris accumsan nibh habitant senectus
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-3 d-flex flex-column">
                <div class="card mb-3">
                    <div class="card-header card-header-lisght">
                        <h3 class="card-title">Reposições em aberto</h3>
                    </div>


                    <table class="table font-sm">
                        <thead>
                            <tr>
                                <th>Data</th>
                                <th>Falta</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($markups as $mk)
                            <tr>
                                <td>{{ $mk->origin->datetime->format('d/m/Y H:i') }}</td>
                                <td>{{ $mk->origin->status->label() }}</td>
                                <td>{{ $mk->expires_at->format('d/m/Y') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>

                <div class="card  flex-fill">
                    <div class="card-header card-header-lisght">
                        <h3 class="card-title">Evoluções</h3>
                    </div>
                    <div class="card-body">
                        <ul class="timeline">
                            @foreach($classes as $date => $class)
                            <li class="timeline-event">
                                <div class="timeline-event-icon bgs-x-lt text-center p-4">
                                    <span><strong>{{ $class->datetime->format('d/m') }}</strong></span>
                                </div>
                                <div class="card timeline-event-card">
                                    <div class="card-body">
                                        <div class="text-secondary float-end">10 hrs ago</div>
                                        <h4>{{ $class->instructor->user->shortName }} <span> escreveu:</span></h4>
                                        <p class="text-secondary">{{  $class->evolution }}
                                        </p>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                            {{-- <li class="timeline-event">
                                <div class="timeline-event-icon">
                                    <!-- Download SVG icon from http://tabler.io/icons/icon/briefcase -->
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="icon icon-1">
                                        <path
                                            d="M3 7m0 2a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v9a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2z" />
                                        <path d="M8 7v-2a2 2 0 0 1 2 -2h4a2 2 0 0 1 2 2v2" />
                                        <path d="M12 12l0 .01" />
                                        <path d="M3 13a20 20 0 0 0 18 0" />
                                    </svg>
                                </div>
                                <div class="card timeline-event-card">
                                    <div class="card-body">
                                        <div class="text-secondary float-end">2 hrs ago</div>
                                        <h4>+3 New Products were added!</h4>
                                        <p class="text-secondary">Congratulations!</p>
                                    </div>
                                </div>
                            </li>
                            <li class="timeline-event">
                                <div class="timeline-event-icon">
                                    <!-- Download SVG icon from http://tabler.io/icons/icon/check -->
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="icon icon-1">
                                        <path d="M5 12l5 5l10 -10" />
                                    </svg>
                                </div>
                                <div class="card timeline-event-card">
                                    <div class="card-body">
                                        <div class="text-secondary float-end">1 day ago</div>
                                        <h4>Database backup completed!</h4>
                                        <p class="text-secondary">Download the <a href="#">latest backup</a>.</p>
                                    </div>
                                </div>
                            </li>
                            <li class="timeline-event">
                                <div class="timeline-event-icon bg-facebook-lt">
                                    <!-- Download SVG icon from http://tabler.io/icons/icon/brand-facebook -->
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="icon icon-1">
                                        <path
                                            d="M7 10v4h3v7h4v-7h3l1 -4h-4v-2a1 1 0 0 1 1 -1h3v-4h-3a5 5 0 0 0 -5 5v2h-3" />
                                    </svg>
                                </div>
                                <div class="card timeline-event-card">
                                    <div class="card-body">
                                        <div class="text-secondary float-end">1 day ago</div>
                                        <h4>+290 Page Likes</h4>
                                        <p class="text-secondary">This is great, keep it up!</p>
                                    </div>
                                </div>
                            </li>
                            <li class="timeline-event">
                                <div class="timeline-event-icon">
                                    <!-- Download SVG icon from http://tabler.io/icons/icon/user-plus -->
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="icon icon-1">
                                        <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                                        <path d="M16 19h6" />
                                        <path d="M19 16v6" />
                                        <path d="M6 21v-2a4 4 0 0 1 4 -4h4" />
                                    </svg>
                                </div>
                                <div class="card timeline-event-card">
                                    <div class="card-body">
                                        <div class="text-secondary float-end">2 days ago</div>
                                        <h4>+3 Friend Requests</h4>
                                        <div class="avatar-list mt-3">

                                            <span class="avatar avatar-2"
                                                style="background-image: url(../../../static/avatars/000m.jpg)"><span
                                                    class="badge bg-success"></span>

                                            </span>


                                            <span class="avatar avatar-2"
                                                style="background-image: url(../../../static/avatars/052f.jpg)"><span
                                                    class="badge bg-success"></span>

                                            </span>


                                            <span class="avatar avatar-2"
                                                style="background-image: url(../../../static/avatars/002m.jpg)"><span
                                                    class="badge bg-success"></span>

                                            </span>


                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="timeline-event">
                                <div class="timeline-event-icon">
                                    <!-- Download SVG icon from http://tabler.io/icons/icon/photo -->
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="icon icon-1">
                                        <path d="M15 8h.01" />
                                        <path
                                            d="M3 6a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v12a3 3 0 0 1 -3 3h-12a3 3 0 0 1 -3 -3v-12z" />
                                        <path d="M3 16l5 -5c.928 -.893 2.072 -.893 3 0l5 5" />
                                        <path d="M14 14l1 -1c.928 -.893 2.072 -.893 3 0l3 3" />
                                    </svg>
                                </div>
                                <div class="card timeline-event-card">
                                    <div class="card-body">
                                        <div class="text-secondary float-end">3 days ago</div>
                                        <h4>+3 New photos</h4>
                                        <div class="mt-3">
                                            <div class="row g-2">
                                                <div class="col-4">
                                                    <!-- Photo -->









                                                    <img src="../../../static/photos/blue-sofa-with-pillows-in-a-designer-living-room-interior.jpg"
                                                        class="rounded"
                                                        alt="Blue sofa with pillows in a designer living room interior" />



                                                </div>
                                                <div class="col-4">
                                                    <!-- Photo -->









                                                    <img src="../../../static/photos/home-office-desk-with-macbook-iphone-calendar-watch-and-organizer.jpg"
                                                        class="rounded"
                                                        alt="Home office desk with Macbook, iPhone, calendar, watch & organizer" />



                                                </div>
                                                <div class="col-4">
                                                    <!-- Photo -->









                                                    <img src="../../../static/photos/young-woman-working-in-a-cafe.jpg"
                                                        class="rounded" alt="Young woman working in a cafe" />



                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="timeline-event">
                                <div class="timeline-event-icon">
                                    <!-- Download SVG icon from http://tabler.io/icons/icon/settings -->
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="icon icon-1">
                                        <path
                                            d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065z" />
                                        <path d="M9 12a3 3 0 1 0 6 0a3 3 0 0 0 -6 0" />
                                    </svg>
                                </div>
                                <div class="card timeline-event-card">
                                    <div class="card-body">
                                        <div class="text-secondary float-end">2 weeks ago</div>
                                        <h4>System updated to v2.02</h4>
                                        <p class="text-secondary">Check the complete changelog at the <a
                                                href="#">activity
                                                page</a>.</p>
                                    </div>
                                </div>
                            </li> --}}
                        </ul>
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