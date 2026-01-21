<div>
    @section('title') Calendário @endsection
    <x-page.page-header>
        <h2 class="page-title">
            <x-icons.users />
            Calendário
        </h2>
        <x-slot name="actions">
            <div class="btn-list">
                <a href="#" wire:click='$dispatch("create-instructor")'
                    class="btn btn-primary btn-5 d-none d-sm-inline-block">
                    <x-icons.plus class="icon icon-1" /> Novo
                </a>
                <a wire:click='$dispatch("create-instructor")' class="btn btn-primary btn-6 d-sm-none btn-icon"
                    aria-label="Novo">
                    <x-icons.plus class="icon icon-1" />
                </a>
            </div>
        </x-slot>
    </x-page.page-header>

    <x-page.page-body>

        <div class="row flex-sfill">

            <div class="col-auto">
                <x-form.select-modality class="filters" name='modality_id' />

            </div>
            <div class="col-auto">
                <x-form.select-class-status class="filters" name="status" />
            </div>
            <div class="col">
                <x-form.select-instructor name="instructor" class="filters" />
            </div>
            <div class="col">
                <x-form.select name="student" class="filters">
                    <option value="">TODOS ({{count($students??[])}})</option>
                    @foreach($students as $key => $name)
                    <option value="{{$key}}">{{$name}}</option>
                    @endforeach
                </x-form.select>
            </div>
        </div>

        <livewire:calendar.full-calendar :endpoint="route('events')" wire:ignore.self wire:key='calendar'
            id="calendar" />

        <livewire:calendar.show-class />

        @if ($showSlotMenu)
        <div class="dropdown-menu show shadow-lg" style="
                position: fixed;
                left: {{ $slotMenuX }}px;
                top: {{ $slotMenuY }}px;
                z-index: 2000;
                min-width: 220px;
            " wire:click.outside="$set('showSlotMenu', false)">
            <h6 class="dropdown-header">
                {{ \Carbon\Carbon::parse($slotDatetime)->format('d/m/Y H:i') }}
            </h6>

            <a href="#" class="dropdown-item" wire:click.prevent="openScheduleClass('{{ $slotDatetime }}')">
                📅 Agendar aula
            </a>

            <a href="#" class="dropdown-item" wire:click.prevent="makeup('{{ $slotDatetime }}')"
                wire:click.prevent="$set('showSlotMenu', false)">
                🔁 Agendar reposição
            </a>

            <div class="dropdown-divider"></div>

            <a href="#" class="dropdown-item text-muted" wire:click.prevent="$set('showSlotMenu', false)">
                ✖ Cancelar
            </a>
        </div>
        @endif

        @if(($slotDatetime))
        <x-modal.modal class="blur" id="modal-makeup" size="modasl-lg">

            <form wire:submit="saveMakeup">
                <div class="modal-content">
                    <div class="modal-header border-0">
                        <h5 class="modal-title align-items-center" id="modalTitleId">
                            <x-icons.calendar /> Agendar Reposição - {{ $slotDatetime->format('d/m/Y H:i') ?? null }}
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body pst-2">
                        <div class="mb-3">

                            <label class="form-label">Aluno</label>
                            <x-form.select name="student" wire:model='makeupStudentId' wire:change='listMakeupClass($event.target.value)'>
                                <option value=""></option>

                                @if($makeupStudents)
                                @foreach($makeupStudents as $key => $name)
                                <option value="{{$key}}">{{$name}}</option>
                                @endforeach
                                @endif
                            </x-form.select>

                        </div>

                        <div class="mb-3">

                            <label class="form-label">Aula a repor</label>
                            <x-form.select name="student" wire:model='makeupId' >
                                <option value=""></option>
                                @if($makeupClasses)
                                @foreach($makeupClasses as $key => $name)
                                <option value="{{$key}}">{{$name}}</option>
                                @endforeach
                                @endif
                            </x-form.select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Professor</label>
                            <x-form.select-instructor wire:model='makeupInstructorId' />
                        </div>
                    </div>





                    <div class="modal-footer border-0 bg-transparent">
                        <button type="button" class="btn btn-link link-secondary me-auto" data-bs-dismiss="modal">
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

        </x-modal.modal>
        @endif

    </x-page.page-body>


</div>
