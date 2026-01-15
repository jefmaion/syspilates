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

                    <div class="card">
                        <div class="card-header">
                            <ul class="nav nav-tabs card-header-tabs" data-bs-toggle="tabs" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a href="#tabs-home-3" class="nav-link active" data-bs-toggle="tab"
                                        aria-selected="true" role="tab">
                Evoluções/Comentários
                                    </a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a href="#tabs-profile-3" class="nav-link" data-bs-toggle="tab"
                                        aria-selected="false" role="tab" tabindex="-1">
                                        <!-- Download SVG icon from http://tabler.io/icons/icon/user -->
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" class="icon me-2 icon-2">
                                            <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"></path>
                                            <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                                        </svg>Profile
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-bodys">
                            <div class="tab-content">
                                <div class="tab-pane active show" id="tabs-home-3" role="tabpanel">
                                    <table class="table text-sm table-striped">
                                                {{-- <thead>
                                                    <tr>
                                                        <th>Linha do Tempo</th>
                                                    </tr>
                                                </thead> --}}
                                                @foreach($registration->classes as $class)
                                                <tr>
                                                    <td class="px-4 border-0 border-top">
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
                                                            <div class="text-secondary">{{ $class->evolution }}</div>

                                                            <a href="#" wire:click="$dispatch('show-class', {id: {{ $class->id }}})">Editar</a>
                                                        </div>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </table>
                                </div>
                                <div class="tab-pane" id="tabs-profile-3" role="tabpanel">
                                    <h4>Profile tab</h4>
                                    <div>
                                        Fringilla egestas nunc quis tellus diam rhoncus ultricies tristique enim at
                                        diam, sem nunc amet, pellentesque id egestas velit sed
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>



                <div class="modal-footer border-0 bg-transparent">
                    <button type="button" class="btn  btn-outline-secondary" data-bs-dismiss="modal">
                        Fechar
                    </button>

                    @if($type == 'schedule')
                    <button type="button" data-bs-dissmiss="modal"
                        wire:click="$dispatch('create-class', {datetime: '{{ $date }}', id: {{ $event['id'] }}})"
                        class="btn btn-primary">
                        <x-page.spinner>Registrar Aula</x-page.spinner>
                    </button>
                    @endif

                    @if($type == 'class')
                    <button type="button" data-bs-dissmiss="modal"
                        wire:click="$dispatch('show-class', {id: {{ $event['id'] }}})" class="btn btn-warning">
                        <x-page.spinner>Editar Dados da Aula</x-page.spinner>
                    </button>
                    @endif
                </div>
            </div>
        </form>
        @endif
    </x-modal.modal>
</div>
