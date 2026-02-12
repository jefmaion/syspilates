<x-modal.modal class="blur" id="modal-makeup" sise="modal-lg">

    @if ($students)

    <form wire:submit="saveMakeup">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title align-items-center" id="modalTitleId">
                    <x-icons.calendar /> Agendar Reposição
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">




                <div class="mb-3">

                    <label class="form-label">Aluno</label>
                    <x-form.select name="makeupStudentId" wire:model='makeupStudentId'
                        wire:change='listAvailableClass($event.target.value)'>
                        <option value=""></option>
                        @foreach ($students as $key => $name)
                        <option value="{{ $key }}">{{ $name }}</option>
                        @endforeach
                    </x-form.select>

                </div>

                <div class="mb-3">

                    <label class="form-label">Aula a repor</label>
                    <x-form.select name="makeupId" wire:model.live='makeupId' wire:change='getClass()'>
                        <option value=""></option>
                        @if ($makeupClasses)
                        @foreach ($makeupClasses as $key => $item)
                        <option value="{{ $key }}">{{ $item }}</option>
                        @endforeach
                        @endif
                    </x-form.select>

                    @if ($class)
                    <div class="card mt-3">
                        <div class="card-header p-2">
                            <div class="d-flex align-items-center justify-content-between">
                                <span class="mx-1">
                                    <x-icons.calendar /><strong> {{ $class->origin->datetime->format('d/m/y')
                                        }}</strong>
                                </span> |
                                <span class="mx-1">
                                    <x-icons.time /> {{ $class->origin->datetime->format('H\h') }}
                                </span> |
                                <span class="mx-1">
                                    <x-page.badge color="{{ $class->origin->status->color() }}">{{
                                        $class->origin->status->label() }}</x-page.badge>
                                </span>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="text-mutesd text-sm mb-2">
                                <x-icons.modality /> {{ $class->origin->modality->name }} |
                                <x-page.avatar size="xs" :user="$class->origin->instructor->user" /> {{
                                $class->origin->instructor->user->shortName ?? null }}
                            </div>
                            <p class="text-muted"><strong>Motivo: </strong>{{ $class->origin->evolution }}</p>
                        </div>
                        <div class="card-body">
                            <span>Valido até: {{ $class->origin->datetime->format('d/m/Y') }}</span>
                        </div>
                    </div>
                    @endif
                </div>
                <div class="mb-3">
                    <label class="form-label">Professor</label>
                    <x-form.select-instructor name="makeupInstructorId" wire:model='makeupInstructorId' />
                </div>
                <div class="mb-3">
                    <label class="form-label">Comentários</label>
                    <textarea class="form-control {{ $errors->has('comments') ? ' is-invalid' : '' }}" rows="5"
                        name="comments" wire:model="comments"></textarea>
                </div>
            </div>
            <div class="modal-footer border-0 bg-transparent">
                <button type="button" class="btn btn-link link-secondary me-auto" data-bs-dismiss="modal">
                    Fechar
                </button>
                <button type="button" class="btn btn-primary" wire:click='saveMakeup'>
                    <x-page.spinner target="saveMakeup">
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