<x-modal.modal class="blur" id="modal-show-card" size="modal-lg">

    @if ($class)
    <div class="modal-status bg-{{ $class->status->color() }}"></div>
    <div class="modal-header">
        <h5 class="modal-title align-items-center" id="modalTitleId">
            <x-icons.calendar /> {{ $eventDatetime ? ucfirst($eventDatetime->translatedFormat('l, d \d\e F \d\e Y -
            H:i\h\r\s')) : '' }}
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body pst-2">




        <x-common.user-block initials="{{ $data?->student->initials }}" size="lg"
            avatar="{{ $data?->student->avatar }}">
            @if ($class && $class->is_makeup)
            <x-slot:prepend>
                <div class="me-1 mb-2 float-end">
                    <x-page.badge color="orange">Aula de Reposição</x-page.badge>
                </div>
            </x-slot:prepend>
            @endif
            <x-slot:title>
                <a href="{{ route('registration.show', $class->registration_id) }}"> {{ $data?->student?->shortName ??
                    null }}</a>
            </x-slot:title>
            <x-slot:side-title>
                <div class="d-flex justify-content-end">
                    @if ($data?->status)
                    <x-page.badge color="{{ $data?->status->color() }}">{{ $data?->status->label() }}</x-page.badge>
                    @endif
                </div>
            </x-slot:side-title>
            <x-slot:subtitle>
                <div class="text-muted text-sm mb-2">
                    <x-icons.modality /> {{ $data?->modality }} |
                    <x-icons.time /> {{ $eventDatetime ? $eventDatetime->format('H\h') : '' }} |
                    <x-icons.phone /> {{ $data?->student->phone1 ?? null }} |
                    <x-page.avatar size="xs" :user="$data?->instructor" /> {{ $data?->instructor->shortName ?? null }}
                </div>

            </x-slot:subtitle>
        </x-common.user-block>
    </div>

    <div class="modal-body">
        <div>
            <strong>Objetivo: </strong> {{ $data?->objective }}
        </div>

        @if ($data->alerts)
        <div class="d-flex justify-content-between">
            @foreach ($data->alerts as $alert)
            <x-common.alert class="mb-0 mt-3 me-2 flex-fill" type="{{ $alert['type'] }}">

                @if (isset($alert['icon']))
                <x-slot:icon>
                    <x-dynamic-component class="icon-pulse" component="{{ $alert['icon'] }}" />
                </x-slot:icon>
                @endif

                <div class="text-center">{{ $alert['text'] }}</div>
            </x-common.alert>
            @endforeach
        </div>
        @endif
        {{-- @if ($data->makeup)
        <x-common.alert class="mb-0 mt-3" type="warning">Reposições à agendar</x-common.alert>
        @endif
        @if ($registration->hasUnpaidTransactions)
        <x-common.alert class="mb-0 mt-3" type="danger">Existem mensalidades em aberto!</x-common.alert>
        @endif --}}

    </div>


    @if (!$history_classes->isEmpty())
    {{-- @dd($data?->history) --}}
    <div class="modal-body">
        <p class="mb-0"><strong>Histórico Recente</strong></p>
        <table class="table table-striped w-100">
            <tbody>
                @foreach ($history_classes as $_class)
                <tr>
                    <td classs="text-center">
                        <div class="mb-3 text-secondary">
                            <strong> {{ $_class->datetime->format('d/m') }} | {{ $_class->datetime->format('H\h') }}
                            </strong> -
                            <span>
                                {{ $_class->type->label() }} -
                            </span>
                            <x-page.avatar size="xs" :user="$_class->instructor?->user" /> <strong>{{
                                $_class->instructor?->user?->shortName ?? null }}</strong> -
                            <x-page.badge color="{{ $_class->status->color() }}">{{ $_class->status->label() }}
                            </x-page.badge>
                        </div>
                        <div class="mb-3">{{ $_class->evolution }}</div>
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
        @if ($class->status == App\Enums\ClassStatusEnum::SCHEDULED)
        <button type="button" data-bs-dissmiss="modal" wire:click="registerClass()" class="btn btn-primary">
            <span class="d-flex align-items-center">
                <x-icons.success class="me-2" /> <span>Registrar Aula</span>
            </span>
        </button>
        @endif
        @if ($class->status !== App\Enums\ClassStatusEnum::SCHEDULED && $class->canEdit)
        <button type="button" data-bs-dissmiss="modal" wire:click="editRegister()" class="btn btn-teal">
            <span class="d-flex align-items-center">
                <x-icons.edit class="me-2" /> <span>Editar</span>
            </span>
        </button>
        @endif
    </div>
    @endif
</x-modal.modal>