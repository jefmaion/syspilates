<div>
    @section('title')
    Calendário
    @endsection
    <x-page.page-header>
        <h2 class="page-title">
            <x-icons.users />
            Calendários
        </h2>

    </x-page.page-header>

    <x-page.page-body>
        <div class="row flex-sfill mb-3">

            <div class="col-auto">
                <x-form.select-modality class="filters"  name='modality_id' wire:change="$dispatch('calendar-filter', { field: 'modality_id', value: $event.target.value })" />

            </div>
            <div class="col-auto">
                <x-form.select-class-status class="filters" name="status" wire:change="$dispatch('calendar-filter', { field: 'status', value: $event.target.value })" />
            </div>

            <div class="col-auto">
                <x-form.select name="type" class="filters" wire:change="$dispatch('calendar-filter', { field: 'type', value: $event.target.value })">
                    <option value=""></option>
                    @foreach (App\Enums\ClassTypesEnum::cases() as $item)
                    <option value="{{ $item->value }}">{{ $item->label() }}</option>
                    @endforeach
                </x-form.select>
            </div>
            <div class="col">
                <x-form.select-instructor name="instructor" class="filters" wire:change="$dispatch('calendar-filter', { field: 'instructor_id', value: $event.target.value })" />
            </div>
            <div class="col">
                <x-form.select name="student" class="filters" wire:change="$dispatch('calendar-filter', { field: 'student_id', value: $event.target.value })">
                    <option value="">TODOS ({{ count($students ?? []) }})</option>
                    @foreach ($students as $key => $name)
                    <option value="{{ $key }}">{{ $name }}</option>
                    @endforeach
                </x-form.select>
            </div>
        </div>
        
     
        <livewire:fullcalendar.fullcalendar  />
      

    </x-page.page-body>


</div>
