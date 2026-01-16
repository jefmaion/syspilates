<div>
    <x-modal.modal class="blur" id="modal-show-event" size="modal-lg">
        @if($registration)
        <form wire:submit="save">
            <div class="modal-content">
                <div class="modal-header bordser-0">
                    <h5 class="modal-title align-items-center" id="modalTitleId">
                        <x-icons.calendar />{{ ucfirst($date->translatedFormat('l, d \d\e F \d\e Y - H:i\h\r\s')); }}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pst-2">
                    <div class="row d-flex flex-fill mb-4">
                        <div class="col">
                            @include('livewire.calendar.event-header')
                        </div>
                        @if($type =='class')
                        <div class="col-auto d-flex align-items-center justify-content-end">
                            <span class="badge bg-{{ $event->status->color() }} text-{{ $event->status->color()}}-fg }}">
                                {{$event->status->label() }}
                            </span>
                        </div>
                        @endif
                    </div>

                    {{-- <div class="alert alert-info mb-0" role="alert">
                      <div class="alert-icon">
                        <!-- Download SVG icon from http://tabler.io/icons/icon/info-circle -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon alert-icon icon-2">
                          <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0"></path>
                          <path d="M12 9h.01"></path>
                          <path d="M11 12h1v4h1"></path>
                        </svg>
                      </div>
                      <div>
                        <h4 class="alert-heading">Objetivo</h4>
                        <div class="alert-description">{{ $registration->student->objective }}</div>
                      </div>
                    </div>
                </div> --}}

                {{-- <div class="modal-body">
                    <strong>Objetivo:</strong> {{ $registration->student->objective }}
                </div> --}}

                

                @if(!$registration->classes->isEmpty())
                <div class="modal-body pb-0">
                    <p><strong>Histórico Recente</strong></p>
                    <table class="table table-striped w-100">
                        <tbody>
                            @foreach($registration->classes as $class)
                            <tr>
                                <td classs="text-center">
                                    {{ $class->date->format('d/m') }}
                                </td>
                                <td classs="text-center">
                                    <span class="badge badge-outline text-{{ $class->status->color() }}">
                                        {{$class->status->label() }}
                                    </span>
                                </td>
                                <td>
                                    <div>{{ $class->evolution }}</div>
                                    <div class="text-muted"><small>Por: {{ $class->instructor->user->name }}</small>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif

                <div class="modal-footer bordser-0 bg-transparent">
                    <button type="button" class="btn btn-link link-secondary me-auto" data-bs-dismiss="modal">
                        Fechar
                    </button>

                    @if($type == 'scheduled')
                    <button type="button" data-bs-dissmiss="modal"
                        wire:click="$dispatch('make-presence', {datetime: '{{ $date }}', id: '{{ $registration->id }}', instructor_id: {{ $props['instructor_id'] }} })"
                        class="btn btn-success">
                        <span class="d-flex align-items-center">
                            <x-icons.calendar class="me-2" /> <span>Marcar Presença</span>
                        </span>
                    </button>

                    <button type="button" data-bs-dissmiss="modal"
                        wire:click="$dispatch('make-absense', {datetime: '{{ $date }}', id: '{{ $registration->id }}', instructor_id: {{ $props['instructor_id'] }} })"
                        class="btn btn-danger">
                        <span class="d-flex align-items-center">
                            <x-icons.calendar class="me-2" /> <span>Marcar Falta</span>
                        </span>
                    </button>
                    @endif

                    @if($type == 'class')
                    @if($event->status->value == 'justified')
                    <button type="button" data-bs-dissmiss="modal"
                        wire:click="$dispatch('create-class', {datetime: '{{ $date }}', id: '{{ $id }}'})"
                        class="btn btn-purple">
                        <x-page.spinner>Agendar reposição</x-page.spinner>
                    </button>
                    @endif
                    <button type="button" data-bs-dissmiss="modal"
                        wire:click="$dispatch('show-class', {id: '{{ $id }}'})" class="btn btn-warning">
                        <x-page.spinner>
                            <x-icons.edit /> Editar Dados
                        </x-page.spinner>
                    </button>
                    @endif
                </div>
            </div>
        </form>
        @endif
    </x-modal.modal>
</div>