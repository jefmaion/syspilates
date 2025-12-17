<div wire:key="registration-show-{{ $registration->id }}">

    @section('title')
    Detalhes da Matrícula
    @endsection
    <x-page.page-header>
        <div class="page-pretitle">Overview</div>
        <h2 class="page-title">
            <x-icons.users />
            Detalhes da Matrícula
        </h2>

    </x-page.page-header>

    <x-page.page-body>

        <livewire:registration.actions.cancel-registration :registration="$registration" />

        <div class="row">
            <div class="col-3 d-flex">
                <div class="card flex-fill">
                    <div class="card-body p-4 text-center">
                        <span class="avatar avatar-xl mb-3">
                            {{ $registration->student->user->initials }}
                        </span>
                        <h3 class="m-0 mb-1"><a href="#">{{ $registration->student->user->name }}</a></h3>
                        <div class="text-secondary">{{ $registration->modality->name }}</div>
                        <div class="mt-3 text-left">
                            <div class="d-flex justify-content-between align-items-center border-top py-3">
                                <span><strong>Aluno desde:</strong></span>
                                <span>{{ $registration->created_at->format('d/m/Y') }}</span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center border-top py-3">
                                <span><strong>Status</strong></span>
                                <span><span class="badge bg-green-lt">{{ $registration->status->label() }}</span></span>
                            </div>
                        </div>

                        <div>
                            <a href="{{ route('registration') }}" class="me-2" wire:navigate>Voltar</a>
                            <button type="button" class="btn btn-primary"
                                wire:click="$dispatch('cancel-registration')">Cancelar Matrícula</button>
                            <button type="button" class="btn btn-primary"
                                wire:click="$dispatch('cancel-registration')">Renovar Matrícula</button>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col d-flex flex-column">

                <div class="card mb-3">
                    <div class="card-header">
                        Informações
                    </div>
                    <div class="card-body">
                        <div class="datagrid">
                            <div class="datagrid-item">
                                <div class="datagrid-title">Status</div>
                                <div class="datagrid-content">
                                    <span class="status status-{{ $registration->status->color() }}">{{
                                        $registration->status->label() }}</span>
                                </div>
                            </div>
                            <div class="datagrid-item">
                                <div class="datagrid-title">Plano</div>
                                <div class="datagrid-content">{{ $registration->duration }}</div>
                            </div>
                            <div class="datagrid-item">
                                <div class="datagrid-title">Aulas p/ Semana</div>
                                <div class="datagrid-content">{{ $registration->class_per_week }}</div>
                            </div>
                            <div class="datagrid-item">
                                <div class="datagrid-title">Vencimento</div>
                                <div class="datagrid-content">{{ $registration->deadline }}</div>
                            </div>
                            <div class="datagrid-item">
                                <div class="datagrid-title">Aulas</div>
                                <div class="datagrid-content">–</div>
                            </div>

                            <div class="datagrid-item">
                                <div class="datagrid-title">Presença</div>
                                <div class="datagrid-content">15 days</div>
                            </div>

                            <div class="datagrid-item">
                                <div class="datagrid-title">Faltas</div>
                                <div class="datagrid-content">15 days</div>
                            </div>



                        </div>
                    </div>
                </div>

                <div class="card flex-fill">
                    <div class="card-header">
                        <ul class="nav nav-tabs card-header-tabs nasv-fill" data-bs-toggle="tabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a href="#tabs-home-7" class="nav-link active" data-bs-toggle="tab" aria-selected="true"
                                    role="tab">
                                    <!-- Download SVG icon from http://tabler.io/icons/icon/home -->
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="icon me-2 icon-2">
                                        <path d="M5 12l-2 0l9 -9l9 9l-2 0"></path>
                                        <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7"></path>
                                        <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6"></path>
                                    </svg>Aulas Planejadas
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a href="#tabs-profile-7" class="nav-link" data-bs-toggle="tab" aria-selected="false"
                                    role="tab" tabindex="-1">
                                    <!-- Download SVG icon from http://tabler.io/icons/icon/user -->
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="icon me-2 icon-2">
                                        <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"></path>
                                        <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                                    </svg>Dados da Matrícula
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a href="#tabs-activity-7" class="nav-link" data-bs-toggle="tab" aria-selected="false"
                                    role="tab" tabindex="-1">
                                    <!-- Download SVG icon from http://tabler.io/icons/icon/activity -->
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="icon me-2 icon-2">
                                        <path d="M3 12h4l3 8l4 -16l3 8h4"></path>
                                    </svg>Histórico de Aulas
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane active show" id="tabs-home-7" role="tabpanel">
                                <form wire:submit='changeClassDays'>
                                    <button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal"
                                        data-bs-target="#modal-classes">Alterar Dias de Aula</button>
                                </form>
                                <x-modal.modal size="modal-lg" id="modal-classes">
                                    <form wire:submit="changeClassDays">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title align-items-center" id="modalTitleId">
                                                    <x-icons.users /> Alterar Dias de Aulas
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
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
                                                                    <x-form.select-weekday
                                                                        name="form.schedule.{{ $i }}.weekday"
                                                                        wire:model='form.schedule.{{ $i }}.weekday' />
                                                                </td>
                                                                <td>
                                                                    <x-form.select-time type="time"
                                                                        name="form.schedule.{{ $i }}.time"
                                                                        wire:model='form.schedule.{{ $i }}.time' />
                                                                </td>
                                                                <td>
                                                                    <x-form.select-instructor
                                                                        name="form.schedule.{{ $i }}.instructor_id"
                                                                        wire:model='form.schedule.{{ $i }}.instructor_id' />
                                                                </td>
                                                            </tr>
                                                            @endfor
                                                    </tbody>
                                                </x-table.table>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn  btn-outline-secondary"
                                                    data-bs-dismiss="modal">
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

                                <x-table.table>
                                    <thead>
                                        <tr>
                                            <th scope="col">Dia</th>
                                            <th scope="col">Horário</th>
                                            <th scope="col">Instrutor</th>
                                            <th>Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($classes as $class)
                                        <tr class="">
                                            <td scope="row">{{ $class['date']->format('d/m/Y') }}</td>
                                            <td>{{ $class['time'] }}</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <span
                                                        class="avatar avatar-sm me-2  {{ ($class['instructor']->user->gender == 'M') ? 'bg-blue-lt' : 'bg-purple-lt' }}">{{
                                                        $class['instructor']->user->initials }}</span>
                                                    {{ $class['instructor']->user->name }}
                                                </div>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-success">Marcar Persença</button>
                                                <button type="button" class="btn btn-danger">Marcar Falta</button>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </x-table.table>

                                {{ $classes->links() }}

                            </div>
                            <div class="tab-pane" id="tabs-profile-7" role="tabpanel">

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="" class="form-label">Plano</label>
                                        <x-form.select-duration name="form.duration" wire:model='form.duration' />
                                    </div>


                                    <div class="col-md-3 mb-3">
                                        <label for="" class="form-label">Valor</label>
                                        <x-form.input-text name="form.value" wire:model='form.value' />
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <label for="" class="form-label">Dia Vencimento</label>
                                        <x-form.input-text name="form.deadline" wire:model='form.deadline' />
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <label for="" class="form-label">Início das Aulas</label>
                                        <x-form.input-text type="date" name="form.start" wire:model='form.start' />
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <label for="" class="form-label">Aulas p/ Semana</label>
                                        <x-form.input-text name="form.class_per_week"
                                            wire:model.live='form.class_per_week' />
                                    </div>
                                </div>


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
            </div>
        </div>






        <!-- Modal Body -->
        <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
        <div class="modal fade" id="modalId" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
            role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTitleId">
                            Modal title
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">Body</div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Close
                        </button>
                        <button type="button" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>
        </div>




    </x-page.page-body>
</div>