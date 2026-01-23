<x-modal.modal class="blur" id="modal-show-card" size="modal-lg">
    <div class="modal-header border-0">
        <h5 class="modal-title align-items-center" id="modalTitleId">
            <x-icons.calendar /> {{ ($eventDatetime) ? ucfirst($eventDatetime->translatedFormat('l, d \d\e F \d\e Y -
            H:i\h\r\s')) : ''; }}
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>

    <div class="modal-body pst-2">
        <x-page.user-block size="lg" class="" :user="$eventStudent ?? null">
            <div class="flex-fill">
                <h3 class="font-weight-medium mb-0">
                    <strong>{{ $eventStudent->shortName ?? null }}</strong>
                </h3>
                <div class="text-secondary text-sm">

                    <x-icons.modality /> {{ $eventModality }} •
                    <x-icons.time /> {{ ($eventDatetime) ? $eventDatetime->format('H:m') : '' }} •
                    <x-icons.phone /> {{ $eventStudent->phone1 ?? null }} •
                    <x-icons.instructor />{{ $eventInstructor->shortName ?? null }}

                </div>

                <div>
                    @if($eventStatus)
                    <x-page.status color="{{  $eventStatus->color() }}">{{$eventStatus->label() }}</x-page.status>
                    @endif
                </div>
            </div>
        </x-page.user-block>
    </div>



    <div class="modal-body">
        <strong>Objetivo:</strong> {{ $eventObjective }}
    </div>

    @if($eventHistory && !$eventHistory->isEmpty())
    <div class="modal-body">
        <p class="mb-0"><strong>Histórico Recente</strong></p>
        <table class="table table-striped w-100">
            <tbody>
                @foreach($eventHistory as $_class)
                <tr>
                    <td classs="text-center">
                        <div class="mb-1">
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

                        <div class="mb-1">{{ $_class->evolution }}</div>
                        <div class="text-muted"><small>
                                <x-icons.instructor /> {{ $_class?->instructor?->user?->shortName }}
                            </small>
                        </div>
                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif

    @if($eventType == 'scheduled')
    @include('livewire.calendar.class-card-scheduled')
    @endif

    @if($eventType == 'class')
    @include('livewire.calendar.class-card-class')
    @endif


</x-modal.modal>