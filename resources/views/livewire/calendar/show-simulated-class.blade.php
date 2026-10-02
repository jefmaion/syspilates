<x-modal.modal class="blur" id="modal-show-simulated-class">
    @if($registration)
    <!-- <div class="modal-status bg-"></div> -->
    <div class="modal-header">
        <h5 class="modal-title align-items-center" id="modalTitleId">
           <x-icons.calendar /> {{ $datetime ? ucfirst($datetime->translatedFormat('l, d \d\e F \d\e Y -
            H:i\h\r\s')) : '' }}
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <x-common.user-block >

                    <x-slot:title>
                        <a href="{{ route('registration.show', $registration) }}" wire:navigate> {{
                            $registration?->student?->user->shortName ??
                            null }}</a>
                    </x-slot:title>
                    <x-slot:side-title>
                        <div class="d-flex justify-content-end">
                            @if ($registration?->status)
                            <x-page.badge color="{{ $registration?->status->color() }}">{{ $registration?->status->label() }}</x-page.badge>
                            @endif
                        </div>
                    </x-slot:side-title>
                    <x-slot:subtitle>
                        <div class="text-muted text-sm mb-2">
                            <x-icons.modality /> {{ $registration?->modality->name }} |
                            <x-icons.phone /> {{ $registration?->student->user->phone1 ?? null }} |
                        </div>

                    </x-slot:subtitle>
                </x-common.user-block>

    </div>

    <div class="modal-body">
        <p>Horários de Aula</p>
        <div class="row">
            @foreach($registration->schedule as $day)
            <div class="col">
                <div class="card card-link">
                          <div class="card-body text-center">
                            <p><strong>{{ $day->weekday->label() }}</strong></p>
                            <p>{{ $day->time }}</p>
                            <div>
                                <x-page.avatar size="xs" :user="$day?->instructor->user" /> {{ $day?->instructor->user->shortName ?? null }}
                            </div>
                          </div>
                        </div>
                
            </div>
            @endforeach
        </div>
    </div>



    <div class="modal-footer bsorder-0 bg-tsransparent">
        <button type="button" class="btn btn-link link-secondary me-auto" data-bs-dismiss="modal">
            Fechar
        </button>

<!--         <a href="{{route('registration.show', [$registration, 'action' => 'renew'])}}" class="btn btn-warning">
            <span class="d-flex align-items-center">
                <x-icons.edit class="me-2" /> <span>Finalizar Matrícula</span>
            </span>
        </a> -->

        <a href="{{route('registration.show', [$registration])}}" class="btn btn-teal">
            <span class="d-flex align-items-center">
                <x-icons.edit class="me-2" /> <span>Acessar Matrícula</span>
            </span>
        </a>

        <livewire:registration.create-registration />

     
    </div>
    @endif
</x-modal.modal>
