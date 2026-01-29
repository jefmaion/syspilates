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

        {{-- <div class="alert alert-warning alert-dismissible" role="alert">
            <div class="alert-icon">
                <!-- Download SVG icon from http://tabler.io/icons/icon/alert-triangle -->
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="icon alert-icon icon-2">
                    <path d="M12 9v4"></path>
                    <path
                        d="M10.363 3.591l-8.106 13.534a1.914 1.914 0 0 0 1.636 2.871h16.214a1.914 1.914 0 0 0 1.636 -2.87l-8.106 -13.536a1.914 1.914 0 0 0 -3.274 0z">
                    </path>
                    <path d="M12 16h.01"></path>
                </svg>
            </div>
            <div>
                <h4 class="alert-heading">Some information is missing!</h4>
                <div class="alert-description">This is a custom alert box with a description.</div>
            </div>
            <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
        </div> --}}

        <livewire:registration.update-class />
        <livewire:calendar.form-register-class />



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

                {{-- <div class="card flex-fill">
                    <div class="card-header card-header-lisght">
                        <h3 class="card-title">Matrícula Atual</h3>
                    </div>

                    <div class="card-body">

  

                        <table class="table">

                            <tbody>
                                <tr>
                                    <td>Última aula:</td>
                                    <td><strong>12/12/2024</strong></td>
                                </tr>

                                <tr>
                                    <td>Próxima aula:</td>
                                    <td><strong>12/12/2024</strong></td>
                                </tr>

                                <tr>
                                    <td>Ultima Evolução:</td>
                                    <td><strong>12/12/2024</strong></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div> --}}
                <div class="card mb-3 flesx-fill">
                            <div class="card-header">
                                <h3 class="card-title">Plano</h3>
                            </div>
                            <div class="card-body">
                                <p>Status: <x-page.badge color="{{ $registration->status->color() }}">{{
                                        $registration->status->label() }}</x-page.badge>
                                </p>
                                <p>Período: <strong>{{$registration->planDescription }}</strong></p>
                                <p>Modalidade: <strong>{{$registration->modality->name }}</strong></p>
                            </div>
                        </div>

                        <div class="card flexs-fill">
                            <div class="card-header">
                                <h3 class="card-title">Mensalidade</h3>
                            </div>
                            <div class="card-body">
                                <p>Status: <x-page.badge>Em Dia</x-page.badge>
                                </p>
                                <p>Próximo Vencimento: <strong>{{ date('d/m/Y') }}</strong></p>
                            </div>
                        </div>
            </div>

            <div class="col d-flex flex-column">

                {{-- <div class="row mb-3">

                   


                    <div class="col d-flex">
                        <div class="card flex-fill">
                            <div class="card-header">
                                <h3 class="card-title">Aulas</h3>
                            </div>
                            <div class="card-body">
                                <p>Aulas: <strong>{{ $countClasses }}</strong></p>
                                <p>Presença: <strong>{{ $presences }}</strong></p>
                                <p>Faltas: <strong>{{ $absenses }}</strong></p>
                            </div>
                        </div>
                    </div>


                   
                </div> --}}

                <div class="row">
                    <div class="col-8 d-flex">
                        <div class="card flex-fill">
                            <div class="card-header">
                                <ul class="nav nav-tabs card-header-tabs" data-bs-toggle="tabs" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <a href="#tab-scheduled" class="nav-link active" data-bs-toggle="tab"
                                            aria-selected="false" role="tab" tabindex="-1">Aulas</a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a href="#tab-makeup" class="nav-link" data-bs-toggle="tab" aria-selected="true"
                                            role="tab">

                                            Reposições</a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a href="#tab-evolution" class="nav-link" data-bs-toggle="tab"
                                            aria-selected="true" role="tab">Evoluções</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="tab-pane fade  active show flex-fill" id="tab-scheduled"
                                        role="tabpanel">
                                        <div>
                                            <x-table.table :search="false" class="mb-3 tablse-sm">
                                                <thead>
                                                    <tr>
                                                        <th style="cursor:pointer" wire:click="sortBy('datetime')">Dia
                                                        </th>
                                                        <th style="cursor:pointer" wire:click="sortBy('datetime')">
                                                            Horário</th>
                                                        <th style="cursor:pointer" wire:click="sortBy('type')">Tipo</th>
                                                        <th style="cursor:pointer" wire:click="sortBy('instructor_id')">
                                                            Instrutor</th>
                                                        <th style="cursor:pointer" wire:click="sortBy('status')">Status
                                                        </th>
                                                        <th>Ações</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($classes as $date => $class)

                                                    <tr class="">
                                                        <td scope="row">
                                                            {{ $class->datetime->format('d/m/Y') }} • {{
                                                            ucfirst($class->datetime->isoFormat('ddd')) }}
                                                        </td>
                                                        <td>{{ $class->datetime->format('H:i') }}</td>
                                                        <td>
                                                            {{ $class->type->label() }}
                                                        </td>
                                                        <td>
                                                            <x-page.user-avatar size="xs"
                                                                :user="$class->instructor->user">
                                                                <span class="small">
                                                                    {{ $class->instructor->user->shortName }}
                                                                </span>
                                                            </x-page.user-avatar>
                                                        </td>

                                                        <td>
                                                            <x-page.badge icon="{{ $class->status->icon() }}"
                                                                color="{{ $class->status->color() }}">


                                                                {{
                                                                $class->status->label()
                                                                }}
                                                            </x-page.badge>

                                                        </td>
                                                        <td class="text-center">
                                                            <div class="btn-actions">
                                                                <a class="btn btn-action text-center" href="#"
                                                                    wire:click="editClass({{ $class->id }})">
                                                                    <!-- Download SVG icon from http://tabler.io/icons/icon/edit -->
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                                        stroke="currentColor" stroke-width="2"
                                                                        stroke-linecap="round" stroke-linejoin="round"
                                                                        class="icon icon-1">
                                                                        <path
                                                                            d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1">
                                                                        </path>
                                                                        <path
                                                                            d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z">
                                                                        </path>
                                                                        <path d="M16 5l3 3"></path>
                                                                    </svg>
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </x-table.table>
                                            {{$classes->links()}}
                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="tab-makeup" role="tabpanel">
                                        @if($markups->isEmpty())
                                        <p class="m-3">Nenhuma reposição encontrada.</p>
                                        @else
                                        <div>
                                            <x-table.table :search="false">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Dia</th>
                                                        <th scope="col">Horário</th>
                                                        <th scope="col">Instrutor</th>
                                                        <th>Tipo da Falta</th>
                                                        <th>Expira em:</th>
                                                        <th>Ações</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($markups as $date => $class)

                                                    <tr class="">
                                                        <td scope="row">{{ $class->origin->datetime->format('d/m/y') }}
                                                            • {{
                                                            ucfirst($class->origin->datetime->translatedFormat('l')) }}
                                                        </td>
                                                        <td>{{ $class->origin->datetime->format('H:i') }}</td>
                                                        <td>
                                                            <x-page.user-avatar size="xs"
                                                                :user="$class->origin->instructor->user">
                                                                <span class="small">
                                                                    {{ $class->origin->instructor->user->shortName }}
                                                                </span>
                                                            </x-page.user-avatar>
                                                        </td>
                                                        <td>
                                                            {{ $class->origin->status->label() }}
                                                        </td>

                                                        <td>
                                                            {{ $class->expires_at->format('d/m/y') }}
                                                        </td>

                                                        <td class="text-center">
                                                            <div class="btn-actions">
                                                                <a class="btn btn-action" href="#"
                                                                    wire:click="editClass({{ $class->id }})">
                                                                    <!-- Download SVG icon from http://tabler.io/icons/icon/edit -->
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                                        stroke="currentColor" stroke-width="2"
                                                                        stroke-linecap="round" stroke-linejoin="round"
                                                                        class="icon icon-1">
                                                                        <path
                                                                            d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1">
                                                                        </path>
                                                                        <path
                                                                            d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z">
                                                                        </path>
                                                                        <path d="M16 5l3 3"></path>
                                                                    </svg>
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </x-table.table>
                                            {{$markups->links()}}
                                        </div>
                                        @endif
                                    </div>

                                    <div class="tab-pane fade" id="tab-evolution" role="tabpanel">
                                        @if($markups->isEmpty())
                                        <p class="m-3">Nenhuma evolução encontrada.</p>
                                        @else
                                        <div>
                                            <ul class="timeline">
                                                @foreach($evolutions as $evol)
                                                <li class="timeline-event">
                                                    <div class="timeline-event-icon bg-x-lt p-4">
                                                        <div class="p-4">{{ $evol->datetime->format('d/m') }}</div>
                                                    </div>
                                                    <div class="card timeline-event-card">
                                                        <div class="card-body">
                                                            <div class="text-secondary float-end">10 hrs ago</div>
                                                            <p class="text-secondary">{{ $evol->evolution }}</p>
                                                            <p>Por <strong>{{ $evol->instructor->user->shortName
                                                                    }}</strong></p>
                                                        </div>
                                                    </div>
                                                </li>
                                                @endforeach

                                            </ul>

                                            {{ $evolutions->links() }}

                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col d-flex flex-column">
                        <div class="card flsex-fill mb-3">
                            <div class="card-header">
                                <h3 class="card-title">Aulas</h3>
                            </div>
                            <div class="card-body">
                                <p>Aulas: <strong>{{ $countClasses }}</strong></p>
                                <p>Presença: <strong>{{ $presences }}</strong></p>
                                <p>Faltas: <strong>{{ $absenses }}</strong></p>
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
                                            <td>{{ $class->origin->datetime->format('d/m/y') }} • {{
                                                ucfirst($class->origin->datetime->isoFormat('ddd')) }}</td>
                                            <td>
                                                <x-page.badge>Ativo</x-page.badge>
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




                {{--
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

                </div> --}}


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