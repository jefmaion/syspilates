<?php

declare(strict_types = 1);

namespace App\Livewire\Calendar;

use App\Enums\ClassStatusEnum;
use App\Models\Classes;
use Carbon\Carbon;
use Closure;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class ShowClassCard extends Component
{
    public $eventId;

    public $eventType;

    public $eventProps;

    public $eventDatetime;

    // ----

    public $data;

    public $registration = null;

    public $class = null;

    #[On('show-class-card')]
    public function open($id, $type, $datetime)
    {
        $this->reset();

        $this->eventId       = $id;
        $this->eventType     = $type;
        $this->eventDatetime = Carbon::parse($datetime);

        $this->loadData();

        $this->dispatch('show-modal', modal:'modal-show-card');
    }

    public function registerClass()
    {
        $this->loadData();
        $this->dispatch('show-form-register', id:$this->eventId, type:$this->eventType)->to(FormRegisterClass::class);
    }

    public function editRegister()
    {
        return $this->registerClass();
    }

    #[On('class-saved')]
    public function saved($id, $type)
    {
        $this->eventType = $type;
        $this->eventId   = $id;

        $this->loadData();

        $this->dispatch('show-event-refresh');
        $this->dispatch('refresh-calendar');
        $this->dispatch('$refresh');
    }

    protected function loadData()
    {
        $this->class        = Classes::with(['student.user', 'modality', 'instructor.user', 'registration.classes'])->find($this->eventId);
        $this->registration = $this->class->registration;

        $this->data = (object) [
            'objective'  => $this->class->student->objective ?? null,
            'history'    => $this->registration?->classes()->where('status', '!=', ClassStatusEnum::SCHEDULED)->get(),
            'instructor' => $this->class->instructor->user,
            'student'    => $this->class?->student->user,
            'modality'   => $this->class->modality->name,
            'status'     => $this->class->status,
        ];
    }

    public function render(): View | Closure | string
    {
        return view('livewire.calendar.show-class-card');
    }
}
