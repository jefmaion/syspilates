<div>
    <x-modal.modal class="blur" id="modal-show-event" size="modal-lg">
        @if($registration)
        <form wire:submit="save">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title align-items-center" id="modalTitleId">
                        <x-icons.users /> Evento {{ $date->format('d/m/Y H:i:s') }}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <x-page.user-block size="lg" :user="$registration->student->user ?? ''">
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
                </div>

                @if(!empty($registration->classes))
                <div class="modal-body">
                    <ul class="timeline timeline-simple">
                        @foreach($registration->classes as $class)
                        <li class="timeline-event">
                            <div class="timeline-event-icon bg-x-lt">
                                <!-- Download SVG icon from http://tabler.io/icons/icon/brand-x -->
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="icon icon-1">
                                    <path d="M4 4l11.733 16h4.267l-11.733 -16z" />
                                    <path d="M4 20l6.768 -6.768m2.46 -2.46l6.772 -6.772" />
                                </svg>
                            </div>
                            <div class="card timeline-event-card">
                                <div class="card-body">
                                    <div class="text-secondary float-end">10 hrs ago</div>
                                    <h4>{{ $class->date }}</h4>
                                    <p class="text-secondary">{{ $class->evolution }}</p>
                                    <p>{{ $class->instructor->user->shortName }}</p>
                                </div>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
                @endif


                <div class="modal-footer">
                    <button type="button" class="btn  btn-outline-secondary" data-bs-dismiss="modal">
                        Fechar
                    </button>

                    @if($type == 'schedule')
                    <button type="button" data-bs-dismiss="modal" wire:click="$dispatch('create-class', {datetime: '{{ $date }}', id: {{ $event['id'] }}})" class="btn btn-primary">
                        <x-page.spinner>Registrar Aula</x-page.spinner>
                    </button>
                    @endif

                    @if($type == 'class')
                    <button type="button" data-bs-dismiss="modal" wire:click="$dispatch('show-class', {id: {{ $event['id'] }}})" class="btn btn-warning">
                        <x-page.spinner>Editar</x-page.spinner>
                    </button>
                    @endif
                </div>
            </div>
        </form>
        @endif
    </x-modal.modal>
</div>