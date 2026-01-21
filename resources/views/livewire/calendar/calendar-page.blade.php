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

        <!-- Modal trigger button -->
        <button
            type="button"
            class="btn btn-primary btn-lg"
            data-bs-toggle="modal"
            data-bs-target="#modalId"
        >
            Launch
        </button>
        
        <!-- Modal Body -->
        <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
        <div
            class="modal fade"
            id="modalId"
            tabindex="-1"
            data-bs-backdrop="static"
            data-bs-keyboard="false"
            
            role="dialog"
            aria-labelledby="modalTitleId"
            aria-hidden="true"
        >
            <div
                class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm"
                role="document"
            >
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTitleId">
                            Modal title
                        </h5>
                        <button
                            type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"
                            aria-label="Close"
                        ></button>
                    </div>
                    <div class="modal-body">Body</div>
                    <div class="modal-footer">
                        <button
                            type="button"
                            class="btn btn-secondary"
                            data-bs-dismiss="modal"
                        >
                            Close
                        </button>
                        <button type="button" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Optional: Place to the bottom of scripts -->
        <script>
            tabler.bootstrap.Modal.getOrCreateInstance(
                document.getElementById("modalId"),
            ).show()
        </script>
        

        <x-modal.modal class="show blur" id="modal-show-events" size="modal-lg">
                            {{-- <livewire:calendar.show-scheduled :event="$currentId" wire:key='scheduled-{{ $currentId }}'  /> --}}

                            asds

        </x-modal.modal>

























    </x-page.page-body>


</div>