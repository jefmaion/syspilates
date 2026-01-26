<div>



        @if(isset($class) && $class->is_makeup && $class->status ==App\Enums\ClassStatusEnum::SCHEDULED)

            <button type="button" data-bs-dissmiss="modal" wire:click="registerClass()" class="btn btn-primary">
                <span class="d-flex align-items-center">
                    <x-icons.calendar class="me-2" /> <span>Registrar Aula</span>
                </span>
            </button>
        @endif



        @if(isset($class) && $class->status !== App\Enums\ClassStatusEnum::SCHEDULED && $class->canEdit)
        <button type="button" data-bs-dissmiss="modal" wire:click="registerClass()" class="btn btn-teal">
            <span class="d-flex align-items-center">
                <x-icons.calendar class="me-2" /> <span>Editar</span>
            </span>
        </button>
        @endif


</div>
