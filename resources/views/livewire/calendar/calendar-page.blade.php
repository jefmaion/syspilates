<div>
    @section('title') Calendário @endsection
    <x-page.page-header>
        <h2 class="page-title">
            <x-icons.users />
            Calendário
        </h2>
        <x-slot name="actions">
            <div class="btn-list">
                <a href="#" wire:click='$dispatch("create-instructor")' class="btn btn-primary btn-5 d-none d-sm-inline-block">
                    <x-icons.plus class="icon icon-1" /> Novo
                </a>
                <a wire:click='$dispatch("create-instructor")' class="btn btn-primary btn-6 d-sm-none btn-icon" aria-label="Novo">
                    <x-icons.plus class="icon icon-1" />
                </a>
            </div>
        </x-slot>
    </x-page.page-header>

    <x-page.page-card-body>
      
        <livewire:calendar.full-calendar wire:ignore.self  wire:key='calendar' id="calendar" />

    </x-page.page-card-body>
</div>