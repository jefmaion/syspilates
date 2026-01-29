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

            <div class="col-auto">
                <x-form.select name="type" class="filters">
                    <option value=""></option>
                    @foreach(App\Enums\ClassTypesEnum::cases() as $item)
                    <option value="{{$item->value}}">{{$item->label()}}</option>
                    @endforeach
                </x-form.select>
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
        <livewire:calendar.full-calendar :endpoint="route('events')" wire:ignore.self wire:key='calendar' id="calendar" :config="$calendarConfig" />

        <livewire:calendar.show-class-card wire:key='{{ $currentId }}' />
        <livewire:calendar.form-register-class wire:key='form-{{ $currentId }}' :except="['scheduled']" />

        <livewire:calendar.create-makeup-class />

        <livewire:calendar.show-experimental-class />
        <livewire:calendar.create-experimental-class />
        <livewire:calendar.register-experimental-class  />

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

                <a href="#" class="dropdown-item" wire:click.prevent="$dispatch('create-experimental-class', { datetime: '{{ $slotDatetime }}' })" wire:click="$set('showSlotMenu', false)">
                    Agendar Aula Experimental
                </a>

                <a href="#" class="dropdown-item" wire:click.prevent="$dispatch('create-makeup-class', { datetime: '{{ $slotDatetime }}' })" wire:click="$set('showSlotMenu', false)">
                    Agendar Reposição
                </a>



                {{-- <a href="#" class="dropdown-item text-muted" wire:click.prevent="$set('showSlotMenu', false)">
                    ✖ Cancelar
                </a> --}}
            </div>

        @endif


    </x-page.page-body>


</div>
