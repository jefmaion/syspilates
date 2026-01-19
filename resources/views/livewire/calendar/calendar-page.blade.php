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
                <x-form.select-student name="student" class="filters" />
            </div>
        </div>

        <livewire:calendar.full-calendar :endpoint="route('events')" wire:ignore.self wire:key='calendar'
            id="calendar" />

        {{-- <livewire:calendar.show-event /> --}}
        <livewire:calendar.show-class />

        {{-- <livewire:calendar.register-class /> --}}

    </x-page.page-body>


</div>
