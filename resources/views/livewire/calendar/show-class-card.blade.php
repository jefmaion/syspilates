<x-modal.modal class="blur" id="modal-show-card" size="modal-lg">

    @if($class)
    <div class="modal-status bg-{{ $class->status->color() }}"></div>
    <div class="modal-header">
        <h5 class="modal-title align-items-center" id="modalTitleId">
            <x-icons.calendar /> {{ ($eventDatetime) ? ucfirst($eventDatetime->translatedFormat('l, d \d\e F \d\e Y -
            H:i\h\r\s')) : ''; }}
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>

    <div class="modal-body pst-2">





        <div class="d-flex">
            <span
                class="avatar rounded-csircle avatar-lg me-2  {{ ($data?->student?->gender == 'M') ? 'bg-blue-lt' : 'bg-purple-lt' }}">{{
                $data?->student?->initials }}</span>
            <div class="flex-fill">
                <div class="d-flex justify-content-between">
                    <h2 class="font-weight-medium mb-2"><strong>
                        <a href="{{ route('registration.show', $class->registration_id) }}"> {{ $data?->student->shortName ?? null }}</a>
                       </strong></h2>
                    <div>
                        @if($data?->status)
                        <x-page.status color="{{  $data?->status->color() }}">{{$data?->status->label() }}
                        </x-page.status>
                        @endif



                        @if($class && $class->is_makeup)
                        <x-page.status color="purple">Reposição</x-page.status>
                        @endif


                    </div>
                </div>

                {{-- <span class="text-muted">{{ ucfirst($eventDatetime->translatedFormat('l, d \d\e F \d\e Y \à\s
                    H:i'))
                    }}</span> --}}
                <div class="text-muted text-sm mb-2">
                    <x-icons.modality /> {{ $data?->modality }} |
                    <x-icons.time /> {{ ($eventDatetime) ? $eventDatetime->format('H\h') : '' }} |
                    <x-icons.phone /> {{ $data?->student->phone1 ?? null }} |
                    <x-icons.instructor />{{ $data?->instructor->shortName ?? null }}
                </div>
                <div>


                    <strong>Objetivo: </strong> {{ $data?->objective }}





                </div>
            </div>
        </div>

        @if($data->makeup)

        <div class="alert alert-warning mb-0 mt-3" role="alert">
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
            Reposições à agendar
        </div>

        @endif




    </div>



    @if(!$history_classes->isEmpty())
    {{-- @dd($data?->history) --}}
    <div class="modal-body">
        <p class="mb-0"><strong>Histórico Recente</strong></p>
        <table class="table table-striped w-100">
            <tbody>
                @foreach($history_classes as $_class)

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

        {{ $history_classes->links() }}
    </div>
    @endif

    <div class="modal-footer bsorder-0 bg-tsransparent">
        <button type="button" class="btn btn-link link-secondary me-auto" data-bs-dismiss="modal">
            Fechar
        </button>

        @if($class->status == App\Enums\ClassStatusEnum::SCHEDULED)
        <button type="button" data-bs-dissmiss="modal" wire:click="registerClass()" class="btn btn-primary">
            <span class="d-flex align-items-center">
                <x-icons.calendar class="me-2" /> <span>Registrar Aula</span>
            </span>
        </button>
        @endif

        @if($class->status !== App\Enums\ClassStatusEnum::SCHEDULED && $class->canEdit)
        <button type="button" data-bs-dissmiss="modal" wire:click="editRegister()" class="btn btn-teal">
            <span class="d-flex align-items-center">
                <x-icons.calendar class="me-2" /> <span>Editar</span>
            </span>
        </button>
        @endif
    </div>

    @endif

</x-modal.modal>
