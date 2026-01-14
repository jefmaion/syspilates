<div>
    <x-modal.modal class="blur" id="modal-show-event" size="modal-lg">
        @if($registration)
        <form wire:submit="save">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title align-items-center" id="modalTitleId">
                        <x-icons.users />{{ $date->translatedFormat('l, d \d\e F \d\e Y - H:i\h\r\s'); }}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <x-page.user-block size="lg" class="mb-4" :user="$registration->student->user ?? ''">
                        <div class="flex-fill">
                            <span class="badge border bg-default-lt">{{ $registration->modality->name ?? '' }}</span>
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

                    @if(!$registration->classes->isEmpty())
                    <div>
                        <table class="table text-sm table-striped">
                            <thead>
                                <tr>
                                    <th>Linha do Tempo</th>
                                </tr>
                            </thead>
                            @foreach($registration->classes as $class)
                            <tr>
                                <td class="px-4 border-0 border-top">
                                    <h4><strong>{{ $class->date->format('d/m/Y') }}</strong> - <x-page.status
                                            color="{{ $class->status->color() }}">{{ $class->status->label() }}
                                        </x-page.status>
                                    </h4>
                                    <div>
                                        <p class="text-secondary">{{ $class->evolution }}</p>
                                        <div>
                                            <div class="d-flex align-items-center">
                                                <span
                                                    class="avatar avatar-sm me-2  {{ ($class->instructor->user->gender == 'M') ? 'bg-blue-lt' : 'bg-purple-lt' }}">{{
                                                    $class->instructor->user->initials }}</span>
                                                <div>{{ $class->instructor->user->name }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                    @endif
                </div>



                <div class="modal-footer">
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