<div>
    @section('title')
    Calendário
    @endsection
    <x-page.page-header>
        <h2 class="page-title">
            <x-icons.users />
            Aulas do Dia
        </h2>
        <x-slot name="actions">
            <x-form.input-text type="date" wire:model.live="date" />
        </x-slot>
    </x-page.page-header>

    <x-page.page-body>

        <livewire:calendar.form-register-class wire:key='form-' :except="['scheduled']" />
        <ul class="timeline">
            @foreach ($rs as $time => $classes)
            <li class="timeline-event">
                <div class="timeline-event-icon bg-{{ date('H') == $time ? 'green' : 'secondary' }} text-white">
                    <span class="p-3 text-center">
                        <div>{{ $time }}h</div>
                    </span>
                </div>
                <div class="card timeline-event-card">

                    <x-table.table class="table-bsordered" :search="false">
                        <thead>
                            <tr>
                                <th width="40%">Aluno</th>
                                <th width="40%">Última Evolução</th>
                                <th class="text-end">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($classes as $class)
                            <tr>
                                <td>
                                    <x-common.user-block initials="{{ $class['initials'] }}" size="sm"
                                        avatar="{{ $class['avatar'] }}">
                                        <x-slot:title>
                                            {{ $class['student']?->shortName ?? $class['student'] }}
                                        </x-slot:title>
                                        <x-slot:side-title>
                                            @if ($class['isReposition'])
                                            <div class="me-1">
                                                <x-page.badge color="orange">Reposição</x-page.badge>
                                            </div>
                                            @endif
                                            <x-page.badge color="{{ $class['status']->color() }}">{{
                                                $class['status']->label() }}</x-page.badge>
                                        </x-slot:side-title>
                                        <x-slot:subtitle>
                                            <div class="text-muted mb-2">
                                                <x-icons.modality /> {{ $class['modality'] }} |
                                                <x-icons.phone /> {{ $class['student']?->phone1 ??
                                                $class['phone'] }} |
                                                <x-page.avatar size="xs" :user="$class['instructor']" /> {{
                                                $class['instructor']->shortName ?? null }}
                                            </div>
                                        </x-slot:subtitle>
                                    </x-common.user-block>

                                    <div class="carsd">
                                        <div class="csard-body p-2 fs-5">
                                            <strong>Objetivo: </strong>{{ $class['objective'] }}</strong>
                                        </div>
                                    </div>


                                </td>

                                <td>

                                    <table>
                                        @foreach ($class['evolutions'] as $evol)
                                        <tr>
                                            <td>
                                                <div>
                                                    <strong>{{ $evol->datetime->format('d/m/y - H\h') }} -
                                                        {{ $evol->instructor->user->shortName }}</strong>
                                                </div>
                                                <div class="text-muted">
                                                    {{ $evol->evolution }}
                                                </div>
                                            </td>
                                        </tr>
                                        @break
                                        @endforeach
                                    </table>
                                </td>
                                <td class="text-end">
                                    <button type="button" data-bs-dissmiss="modal"
                                        wire:click.prevent="$dispatch('show-form-register', {id:'{{ $class['id'] }}', type:'{{ $class['type'] }}'} )"
                                        class="btn btn-primary">
                                        <span class="d-flex align-items-center">
                                            <x-icons.success class="me-2" /> <span>Registrar Aula</span>
                                        </span>
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </x-table.table>


                </div>
            </li>
            @endforeach
        </ul>
    </x-page.page-body>


</div>