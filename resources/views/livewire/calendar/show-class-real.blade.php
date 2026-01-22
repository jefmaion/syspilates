<div>
    <x-modal.modal class="blur" id="modal-show-real" size="modal-lg">
       @if($registration)
         <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title align-items-center" id="modalTitleId">
                    <x-icons.calendar />{{ ucfirst($datetime->translatedFormat('l, d \d\e F \d\e Y - H:i\h\r\s')); }}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pst-2">

                <div class="row d-flex flex-fill mbs-4">
                    <div class="col">
                        @include('livewire.calendar.event-header')
                    </div>

                    <div class="col-auto d-flex align-items-center justify-content-end">
                        <x-page.status color="{{  $this->class->status->color() }}">
                            {{$this->class->status->label() }}</x-page.status>
                    </div>

                </div>
            </div>

            <div class="modal-body">
                <strong>Objetivo:</strong> {{ $registration->student->objective }}
            </div>

            @if(!$registration->classes->isEmpty())
            <div class="modal-body spb-0">
                <p class="mb-0"><strong>Histórico Recente</strong></p>

                <table class="table table-striped w-100">
                    <tbody>
                        @foreach($registration->classes as $_class)
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
                                <div class="text-muted"><small>Por: {{ $_class->instructor->user->name }}</small>
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

                <button type="button" data-bs-dissmiss="modal" wire:click="editClass()" class="btn btn-primary">
                    <span class="d-flex align-items-center">
                        <x-icons.calendar class="me-2" /> <span>Editar Aula</span>
                    </span>
                </button>

            </div>
        </div>
       @endif
    </x-modal.modal>

    
</div>