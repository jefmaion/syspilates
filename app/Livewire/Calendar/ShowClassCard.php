<?php

declare(strict_types=1);

namespace App\Livewire\Calendar;

use App\Enums\ClassStatusEnum;
use App\Models\Classes;
use App\Models\ClassMakeup;
use App\Traits\PaginationTrait;
use Carbon\Carbon;
use Closure;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class ShowClassCard extends Component
{
    // use PaginationTrait;

    use WithPagination;

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
        $this->resetPage();

        $this->dispatch('show-modal', modal: 'modal-show-card');
    }

    public function registerClass()
    {
        $this->loadData();
        $this->dispatch('show-form-register', id: $this->eventId, type: $this->eventType)->to(FormRegisterClass::class);
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

        $makeup = ClassMakeup::with('origin.student.user')->where('status', 'active')->where('student_id', $this->class->student_id)->where('expires_at', '>=', now())->count();

        $alerts = [];

        if ($this->class->student->user->isBirthday) {
            $alerts[] = [
                'icon' => 'icons.cake',
                'type' => 'info',
                'text' => 'Aniversario hoje (' . $this->class->student->user->age . ' anos)'
            ];
        }

        if ($makeup) {
            $alerts[] = [
                'type' => 'warning',
                'text' => 'Reposições à agendar'
            ];
        }

        if ($this->registration->hasLastUnpaidTransactions) {
            $alerts[] = [
                'type' => 'danger',
                'text' => 'Existem mensalidades em aberto!'
            ];
        }



        $this->data = (object) [
            'objective'  => $this->class->student->objective ?? null,
            'instructor' => $this->class->instructor->user,
            'student'    => $this->class?->student->user,
            'modality'   => $this->class->modality->name,
            'status'     => $this->class->status,
            'makeup'     => $makeup,
            'alerts' => $alerts
        ];
    }

    protected function history()
    {

        if (!$this->class) return;

        $ids = Classes::where('modality_id', $this->class?->modality_id)
            ->where('student_id', $this->class?->student_id)
            ->where('status', '!=', ClassStatusEnum::SCHEDULED)
            ->orderBy('datetime', 'desc')
            ->limit(10)
            ->pluck('id');

        return Classes::with('instructor.user')->whereIn('id', $ids)
            ->orderBy('datetime', 'desc')
            ->paginate(2);
    }

    public function render(): View | Closure | string
    {
        return view('livewire.calendar.show-class-card', [
            'history_classes' => $this->history(),
        ]);
    }
}
