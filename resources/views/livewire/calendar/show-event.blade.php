<div>
    <x-modal.modal class="blur" id="modal-show-event" size="modal-lg">
        @if($registration)
        <form wire:submit="save">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h5 class="modal-title align-items-center" id="modalTitleId">
                        <x-icons.calendar />{{ ucfirst($date->translatedFormat('l, d \d\e F \d\e Y - H:i\h\r\s')); }}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pt-2">
                    <x-page.user-block size="lg" class="" :user="$registration->student->user ?? ''">
                        <div class="flex-fill">
                            <h4 class="font-weight-medium mb-0"> <strong>{{ $registration->student->user->shortName ??
                                    '' }}</strong> - <small></small></h4>
                            <div class="text-secondary">
                                {{-- {{ $registration->student->user->phone1 ?? '' }} |
                                | --}}

                                {{ $registration->modality->name ?? '' }}
                            </div>
                            <div class="text-secondary">
                                Professor: {{
                                $registration->getInstructorByWeekday($date->format('w'))->instructor->user->name ??
                                '' }}
                            </div>
                        </div>
                    </x-page.user-block>



                    {{--
                    <div class="card-tabs" style="min-height: 300px;">
                        <!-- Cards navigation -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item" role="presentation"><a href="#tab-top-1" class="nav-link active"
                                    data-bs-toggle="tab" aria-selected="true" role="tab">Evoluções/Comentários</a></li>
                            <li class="nav-item" role="presentation"><a href="#tab-top-2" class="nav-link"
                                    data-bs-toggle="tab" aria-selected="false" role="tab" tabindex="-1">Tab 2</a></li>
                            <li class="nav-item" role="presentation"><a href="#tab-top-3" class="nav-link"
                                    data-bs-toggle="tab" aria-selected="false" role="tab" tabindex="-1">Tab 3</a></li>
                            <li class="nav-item" role="presentation"><a href="#tab-top-4" class="nav-link"
                                    data-bs-toggle="tab" aria-selected="false" tabindex="-1" role="tab">Tab 4</a></li>
                        </ul>
                        <div class="tab-content ">
                            <!-- Content of card #1 -->
                            <div id="tab-top-1" class="card tab-pane active show" role="tabpanel">
                                <div class="card-bodys">







                                </div>
                            </div>
                            <!-- Content of card #2 -->
                            <div id="tab-top-2" class="card tab-pane" role="tabpanel">
                                <div class="card-body">
                                    <div class="card-title">Content of tab #2</div>
                                    <p class="text-secondary">
                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci, alias
                                        aliquid distinctio dolorem expedita, fugiat hic magni
                                        molestiae molestias odit.
                                    </p>
                                </div>
                            </div>
                            <!-- Content of card #3 -->
                            <div id="tab-top-3" class="card tab-pane" role="tabpanel">
                                <div class="card-body">
                                    <div class="card-title">Content of tab #3</div>
                                    <p class="text-secondary">
                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci, alias
                                        aliquid distinctio dolorem expedita, fugiat hic magni
                                        molestiae molestias odit.
                                    </p>
                                </div>
                            </div>
                            <!-- Content of card #4 -->
                            <div id="tab-top-4" class="card tab-pane" role="tabpanel">
                                <div class="card-body">
                                    <div class="card-title">Content of tab #4</div>
                                    <p class="text-secondary">
                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci, alias
                                        aliquid distinctio dolorem expedita, fugiat hic magni
                                        molestiae molestias odit.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div> --}}



                </div>

                <div class="modal-body">

                    <div class="alert alert-warning" role="alert">
                      <div class="alert-icon">
                        <!-- Download SVG icon from http://tabler.io/icons/icon/alert-triangle -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon alert-icon icon-2">
                          <path d="M12 9v4"></path>
                          <path d="M10.363 3.591l-8.106 13.534a1.914 1.914 0 0 0 1.636 2.871h16.214a1.914 1.914 0 0 0 1.636 -2.87l-8.106 -13.536a1.914 1.914 0 0 0 -3.274 0z"></path>
                          <path d="M12 16h.01"></path>
                        </svg>
                      </div>
                      Some information is missing!
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="card card-sm">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <span class="bg-red-lt avatar">
                                                <!-- Download SVG icon from http://tabler.io/icons/icon/arrow-up -->
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="icon icon-1">
                                                    <path d="M12 5l0 14"></path>
                                                    <path d="M18 11l-6 -6"></path>
                                                    <path d="M6 11l6 -6"></path>
                                                </svg>
                                            </span>
                                        </div>
                                        <div class="col">
                                            <div class="font-weight-medium">
                                                Faltas: 32
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                             <div class="card card-sm">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <span class="bg-red-lt avatar">
                                                <!-- Download SVG icon from http://tabler.io/icons/icon/arrow-up -->
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="icon icon-1">
                                                    <path d="M12 5l0 14"></path>
                                                    <path d="M18 11l-6 -6"></path>
                                                    <path d="M6 11l6 -6"></path>
                                                </svg>
                                            </span>
                                        </div>
                                        <div class="col">
                                            <div class="font-weight-medium">
                                                Faltas: 32
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card card-sm">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <span class="bg-green-lt avatar">
                                                <!-- Download SVG icon from http://tabler.io/icons/icon/arrow-up -->
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="icon icon-1">
                                                    <path d="M12 5l0 14"></path>
                                                    <path d="M18 11l-6 -6"></path>
                                                    <path d="M6 11l6 -6"></path>
                                                </svg>
                                            </span>
                                        </div>
                                        <div class="col">
                                            <div class="font-weight-medium">
                                                Presenças: 32
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                @if(!empty($classes))
                <div class="modal-body">
                    <p><strong>Histórico Recente</strong></p>


                    <table class="table text-sm table-striped w-100">
                        @foreach($classes as $class)
                        <tr>
                            <td classs="text-center">
                                {{ $class->date->format('d/m') }}
                            </td>
                            <td classs="text-center">
                                <span class="badge badge-outline text-{{ $class->status->color() }}">{{
                                    $class->status->label() }}</span>

                            </td>
                            <td>

                                <div>{{ $class->evolution }}</div>

                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
                @endif




                <div class="modal-footer bordser-0 bg-transparent">


                    <button type="button" class="btn btn-link link-secondary me-auto" data-bs-dismiss="modal">
                        Fechar
                    </button>

                    @if($type == 'scheduled')
                    <button type="button" data-bs-dissmiss="modal"
                        wire:click="$dispatch('create-class', {datetime: '{{ $date }}', id: '{{ $id }}'})"
                        class="btn btn-primary">
                        <x-page.spinner>Registrar Aula</x-page.spinner>
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
                        <x-page.spinner>Editar Dados da Aula</x-page.spinner>
                    </button>
                    @endif
                </div>
            </div>
        </form>
        @endif
    </x-modal.modal>
</div>
