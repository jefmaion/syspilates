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
                    <x-page.user-block size="lg" class="mb-4" :user="$registration->student->user ?? ''">
                        <div class="flex-fill">
                            <h2 class="font-weight-medium mb-0"> <strong>{{ $registration->student->user->shortName ??
                                    '' }}</strong></h2>
                            <div class="text-secondary">
                                {{ $registration->student->user->phone1 ?? '' }} |
                                {{ $registration->modality->name ?? '' }} |
                                {{ $registration->getInstructorByWeekday($date->format('w'))->instructor->user->name ??
                                '' }}
                            </div>
                        </div>
                    </x-page.user-block>

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
                                <div class="card-body">
                                    @if(!empty($classes))
                                <table class="table text-sm table-striped">
                                    @foreach($classes as $class)
                                    <tr>
                                        <td class="">
                                            <h4><strong>{{ $class->date->format('d/m/Y') }}</strong> -
                                                <x-page.status color="{{ $class->status->color() }}">{{
                                                    $class->status->label() }}
                                                </x-page.status>
                                            </h4>
                                            <div>
                                                <div class="d-flex align-items-center">
                                                    <span
                                                        class="avatar avatar-sm me-2  {{ ($class->instructor->user->gender == 'M') ? 'bg-blue-lt' : 'bg-purple-lt' }}">{{
                                                        $class->instructor->user->initials }}</span>
                                                    <div>{{ $class->instructor->user->name }}</div>
                                                </div>
                                            </div>
                                            <div>
                                                <p class="text-secondary">{{ $class->evolution }}</p>

                                                <a href="#"
                                                    wire:click="$dispatch('show-class', {id: {{ $class->id }}})">Editar</a>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </table>
                                @endif
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
                    </div>



                </div>



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