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
                    <div class="csard timeline-event-card">
                        <div class="row">
                            @foreach ($classes as $class)
                                <div class="col d-flex ">
                                    <div class="card flex-fill">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-12 ">
                                                    <x-common.user-block initials="{{ $class['initials'] }}" size="lg" avatar="{{ $class['avatar'] }}">
                                                        <x-slot:title>
                                                            {{ $class['student']?->shortName ?? $class['student'] }}
                                                        </x-slot:title>
                                                        <x-slot:side-title>
                                                            @if ($class['isReposition'])
                                                                <div class="me-1"><x-page.badge color="orange">Reposição</x-page.badge></div>
                                                            @endif
                                                            <x-page.badge color="{{ $class['status']->color() }}">{{ $class['status']->label() }}</x-page.badge>
                                                        </x-slot:side-title>
                                                        <x-slot:subtitle>
                                                            <div class="text-muted mb-2">
                                                                <x-icons.modality /> {{ $class['modality'] }} |
                                                                <x-icons.phone /> {{ $class['student']?->phone1 ?? $class['phone'] }} |
                                                                <x-page.avatar size="xs" :user="$class['instructor']" /> {{ $class['instructor']->shortName ?? null }}
                                                            </div>
                                                        </x-slot:subtitle>
                                                    </x-common.user-block>

                                                    {{-- <div class="row mb-3">
                                                        <div class="col-auto pe-0">
                                                            <x-common.avatar initials="{{ $class['initials'] }}" size="lg" avatar="{{ $class['avatar'] }}" />
                                                        </div>
                                                        <div class="col">
                                                            <div class="d-flex align-items-center">

                                                                <h2 class="font-weight-medium mb-0 me-1">
                                                                    <strong>
                                                                        {{ $class['student']?->shortName ?? $class['student'] }}
                                                                    </strong>
                                                                </h2>

                                                                @if ($class['isClass'])
                                                                    <x-page.badge color="{{ $class['status']->color() }}">{{ $class['status']->label() }}</x-page.badge>
                                                                @else
                                                                    <x-page.badge color="purple">Experimental</x-page.badge>
                                                                @endif

                                                            </div>
                                                            <div class="text-muted mt-1">
                                                                <x-icons.modality /> {{ $class['modality'] }} |
                                                                <x-icons.phone /> {{ $class['phone'] }} |
                                                                <x-page.avatar size="xs" :user="$class['instructor']" /> {{ $class['instructor_name'] }}
                                                            </div>
                                                        </div>

                                                    </div> --}}
                                                    {{-- 
                                                    <x-common.user-block @if (is_object($class['student'])) :user="$class['student']" @endif>
                                                        <x-slot:subtitle>
                                                            <x-page.badge color="{{ $class['status']->color() }}">{{ $class['status']->label() }}</x-page.badge>
                                                        </x-slot:subtitle>
                                                        <div class="text-muted mb-2">
                                                            <x-icons.modality /> {{ $class['modality'] }} |
                                                            <x-icons.phone /> {{ $class['student']->phone1 ?? null }} |
                                                            <x-page.avatar size="xs" :user="$class['instructor']" /> {{ $class['instructor']->shortName ?? null }}
                                                        </div>
                                                    </x-common.user-block> --}}
                                                    <div class="card mb-3">
                                                        <div class="card-body">
                                                            <strong>Objetivo: </strong>
                                                            {{ $class['objective'] }}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    @if (!empty($class['evolutions']))
                                                        <div>
                                                            <strong>
                                                                Últimas Evoluções
                                                            </strong>
                                                        </div>
                                                        <table class="table mt-0">
                                                            <tbody>
                                                                @foreach ($class['evolutions'] as $evol)
                                                                    <tr>
                                                                        <td>
                                                                            <div>
                                                                                <strong>{{ $evol->datetime->format('d/m/y - H\h') }} - {{ $evol->instructor->user->shortName }}</strong>
                                                                            </div>
                                                                            <div class="text-muted">
                                                                                {{ $evol->evolution }}
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <button type="button" data-bs-dissmiss="modal" wire:click.prevent="$dispatch('show-form-register', {id:'{{ $class['id'] }}', type:'{{ $class['type'] }}'} )" class="btn btn-primary">
                                                <span class="d-flex align-items-center">
                                                    <x-icons.success class="me-2" /> <span>Registrar Aula</span>
                                                </span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
    </x-page.page-body>


</div>
