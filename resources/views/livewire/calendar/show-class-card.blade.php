<x-modal.modal class="blur" id="modal-show-card" size="modal-lg">
    <div class="modal-header border-0">
        <h5 class="modal-title align-items-center" id="modalTitleId">
            <x-icons.calendar /> {{ ($eventDatetime) ? ucfirst($eventDatetime->translatedFormat('l, d \d\e F \d\e Y -
            H:i\h\r\s')) : ''; }}
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>

    <div class="modal-body pst-2">

        <div class="d-flex aslign-items-center">
            <span
                class="avatar rounded-csircle avatar-lg me-2  {{ ($eventStudent?->gender == 'M') ? 'bg-blue-lt' : 'bg-purple-lt' }}">{{$eventStudent?->initials
                }}</span>
            <div class="flex-fill">
                <h3 class="font-weight-medium mb-1">
                    <strong>{{ $eventStudent->shortName ?? null }}</strong>
                </h3>
                <div class="text-secondary text-sm mb-1">

                    <x-icons.modality /> {{ $eventModality }} |
                    <x-icons.time /> {{ ($eventDatetime) ? $eventDatetime->format('H\h') : '' }} |
                    <x-icons.phone /> {{ $eventStudent->phone1 ?? null }} |
                    <x-icons.instructor />{{ $eventInstructor->shortName ?? null }}

                </div>


            </div>
            {{-- <a href="{{ route('instructor.show', $item) }}" wire:navigate>{{ $user->name }}</a> --}}
        </div>

    </div>

    <div class="modal-body">
        <div class="mb-1 mst-3 text-sm text-secondary">
            <strong>Objetivo: </strong> {{ $eventObjective }}
        </div>

        <div class="mt-3">
            @if($eventStatus)
            <x-page.status color="{{  $eventStatus->color() }}">{{$eventStatus->label() }}</x-page.status>
            @endif

            @if($class && $class->is_makeup)
            <x-page.status color="purple">Reposição</x-page.status>
            @endif
        </div>
    </div>



    {{-- <div class="modal-body">
        <strong>Objetivo:</strong> {{ $eventObjective }}
    </div> --}}

    @if($eventHistory && !$eventHistory->isEmpty())
    {{-- @dd($eventHistory) --}}
    <div class="modal-body">
        <p class="mb-0"><strong>Histórico Recente</strong></p>
        <table class="table table-striped w-100">
            <tbody>
                @foreach($eventHistory as $_class)

                <tr>
                    <td classs="text-center">
                        <div class="mb-3 text-secondary">
                            <strong> {{ $_class->datetime->format('d/m') }} às {{
                                $_class->datetime->format('H:i')}} </strong> -

                            <span>
                                {{ $_class->type->label() }} -
                            </span>

                            <span
                                class="badge bg-{{ $_class->status->color() }} text-{{ $_class->status->color() }}-fg">
                                {{$_class->status->label() }}
                            </span>
                        </div>

                        <div class="mb-3">{{ $_class->evolution }}</div>
                        <div class="text-muted"><small>
                                <x-icons.instructor /> <strong>{{ $_class->instructor?->user?->shortName ?? null
                                    }}</strong> em <strong>{{$_class->created_at->format('d/m/y \à\s H:i:s')}}</strong>
                            </small>
                        </div>
                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif

    <div class="modal-footer border-0 bg-transparent">
        <button type="button" class="btn btn-link link-secondary me-auto" data-bs-dismiss="modal">
            Fechar
        </button>
        @if($eventStatus == App\Enums\ClassStatusEnum::SCHEDULED)
        @include('livewire.calendar.class-card-scheduled')
        @else
        @include('livewire.calendar.class-card-class')
        @endif
    </div>


</x-modal.modal>
