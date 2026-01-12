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

    <x-page.page-show>
        <x-slot:left>
            <div class="card  mb-3">
                <div class="card-body p-4 text-center">
                    <span class="avatar avatar-xl mb-3">
                        {{ $registration->student->user->initials }}
                    </span>
                    <h3 class="m-0 mb-1"><a href="#">{{ $registration->student->user->name }}</a></h3>
                    <div class="text-secondary">{{ $registration->modality->name }}</div>
                    {{-- <div class="mt-3">
                        <span class="badge bg-{{ $instructor->user->active ? 'green' : 'secondary' }}-lt">{{
                            $instructor->user->status }}</span>
                    </div> --}}
                </div>
                <div class="card-body">

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('registration') }}" class="btn btn-link me-2" wire:navigate>Voltar</a>
                        <div class="dropdown">
                            <a href="#" class="btn dropdown-toggle" data-bs-toggle="dropdown">Ações</a>
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
                                <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#modal-classes">
                                    <form wire:submit='changeClassDays'>
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="icon dropdown-item-icon icon-tabler icon-tabler-pencil" width="24"
                                            height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                            fill="none" stroke-linecap="round" stroke-linejoin="round">
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

            <div class="card flex-fill">
                <div class="card-header">
                    <h3 class="card-title">Informações</h3>
                </div>
                <div class="cardS-body">

                    <table class="table table-striped table-vcenter mb-0">
                        <tr>
                            <td><strong>Matriculado desde:</strong></td>
                            <td class="text-end">{{ $registration->created_at->format('d/m/Y') }}</td>
                        </tr>
                        <tr>
                            <td><strong>Status:</strong></td>
                            <td class="text-end"><span class="status status-{{ $registration->status->color() }}">{{
                                    $registration->status->label() }}</span></td>
                        </tr>
                        <tr>
                            <td><strong>Plano</strong></td>
                            <td class="text-end">{{ $registration->duration }}</td>
                        </tr>

                        <tr>
                            <td><strong>Aulas p/ Semana</strong></td>
                            <td class="text-end">{{ $registration->class_per_week }}</td>
                        </tr>
                        <tr>
                            <td><strong>Vencimento</strong></td>
                            <td class="text-end">{{ $registration->deadline }}</td>
                        </tr>

                        

                    </table>
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
                                        <th>Status</th>
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
                                                    class="avatar avatar-sm me-2  {{ ($class['instructor']?->user?->gender == 'M') ? 'bg-blue-lt' : 'bg-purple-lt' }}">{{
                                                    $class['instructor']->user->initials }}</span>
                                                {{ $class['instructor']->user->name }}
                                            </div>
                                        </td>
                                        <td>
                                            <span class="status status-{{ $class['status']->color() }}">{{ $class['status']->label() }}</span>
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
        </x-slot:right>
    </x-page.page-show>







</div>