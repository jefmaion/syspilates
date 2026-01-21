<div>
    <x-modal.modal class="blur" id="modal-show-class" size="modal-lg">
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
                        @if($props['type'] =='class')
                        <div>
                            <x-page.status color="{{ $class->status->color() }}"> {{$class->status->label()  }}</x-page.status>
                        </div>


                        @else
                            <x-page.status color="{{  App\Enums\ClassStatusEnum::SCHEDULED->color() }}">  {{App\Enums\ClassStatusEnum::SCHEDULED->label() }}</x-page.status>
                        @endif
                    </div>

                </div>

                @if(!empty($class->makeupClass->makeup))
                <div class="alert alert-warning mb-0 mt-3" role="alert">
                    {{-- <div class="alert-icon">
                        <!-- Download SVG icon from http://tabler.io/icons/icon/alert-triangle -->

                    </div> --}}
                    Reposição em {{ $class->makeupClass->makeup->datetime->format('d/m/Y \à\s\ H:i') }}
                </div>
                @endif

                @if(!empty($class->originMakeupClass))
                <div class="alert alert-warning mb-0 mt-3" role="alert">
                    {{-- <div class="alert-icon">
                        <!-- Download SVG icon from http://tabler.io/icons/icon/alert-triangle -->

                    </div> --}}
                    Reposição do dia <b>{{ $class->originMakeupClass->origin->datetime->format('d/m/Y \à\s\ H:i') }}</b>
                </div>
                @endif
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

                                    <span class="badge bg-{{ $_class->status->color() }} text-{{ $_class->status->color() }}-fg">
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



                {{-- <table class="table table-striped w-100">
                    <tbody>
                        @foreach($registration->classes as $class)
                        <tr>
                            <td classs="text-center">
                                {{ $class->datetime->format('d/m') }} - {{ $class->datetime->format('H:i')}}
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
                </table> --}}
            </div>
            @endif

            <div class="modal-footer border-0 bg-transparent">
                <button type="button" class="btn btn-link link-secondary me-auto" data-bs-dismiss="modal">
                    Fechar
                </button>

                @if(($props['type'] == 'scheduled') || ($props['type'] == 'class' && $class->is_makeup == 1 &&
                $class->status == App\Enums\ClassStatusEnum::SCHEDULED ))
                <button type="button" data-bs-dissmiss="modal" wire:click="makePresence()" class="btn btn-primary">
                    <span class="d-flex align-items-center">
                        <x-icons.calendar class="me-2" /> <span>Registrar Aula</span>
                    </span>
                </button>
                @endif


                @if($props['type'] == 'class' && $class->status !== App\Enums\ClassStatusEnum::SCHEDULED &&
                $class->canEdit)
                <button type="button" data-bs-dissmiss="modal" wire:click="editClass()" class="btn btn-primary">
                    <span class="d-flex align-items-center">
                        <x-icons.calendar class="me-2" /> <span>Editar</span>
                    </span>
                </button>
                @endif


            </div>
        </div>
        @endif
    </x-modal.modal>

    <x-modal.modal class="blur" id="modal-register-class" size="xl">
        @if($registration)
        <form wire:submit="save">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h5 class="modal-title align-items-center" id="modalTitleId">
                        {{--
                        <x-icons.calendar />{{ ucfirst($date->translatedFormat('l, d \d\e F \d\e Y - H:i\h\r\s')); }}
                        --}}
                        <x-icons.calendar />{{ $props['scheduled_datetime'] }}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pst-2">
                    <div class="row d-flex flex-fill mbs-4">
                        <div class="col">
                            @include('livewire.calendar.event-header')
                        </div>
                    </div>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label for="" class="form-label">Status</label>
                        <x-form.select-class-status wire:model='status' />
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Evolução/Comentários</label> <textarea class="form-control" rows="5"
                            name="evolution" wire:model="evolution"></textarea>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn  btn-outline-secondary" data-bs-dismiss="modal">
                        Fechar
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <x-page.spinner>
                            <span class="d-flex align-items-center">
                                <x-icons.success class="me-2" /> <span>Salvar</span>
                            </span>
                        </x-page.spinner>
                    </button>
                </div>
            </div>
        </form>
        @endif
    </x-modal.modal>

    <x-modal.modal class="blur" id="modal-show-exp" ssize="modal-lg">
        @if($exp)
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title align-items-center" id="modalTitleId">
                    <x-icons.calendar />{{ ucfirst($exp->datetime->translatedFormat('l, d \d\e F \d\e Y -
                    H:i\h\r\s')); }}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pst-2">
                    <div class="flex-fill">
                        <h4 class="font-weight-medium mb-0">
                            <strong>{{ $exp->name ?? '' }}</strong>
                        </h4>
                        <div class="text-secondary">
                            <div><strong>Modalidade: </strong> {{ $exp->modality->name }}</div>
                            <div><strong>Professor:</strong> {{ $exp->instructor->user->shortName }}</div>
                        </div>
                     
                    </div>

            </div>

            <div class="modal-body">
                <div><strong>Comentários:</strong></div>
                <div>{{ $exp->comments }}</div>
            </div>




            <div class="modal-footer border-0 bg-transparent">
                <button type="button" class="btn btn-link link-secondary me-auto" data-bs-dismiss="modal">
                    Fechar
                </button>




            </div>
        </div>
        @endif
    </x-modal.modal>
</div>