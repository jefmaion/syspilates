<?php

declare(strict_types = 1);

namespace App\Livewire\Calendar;

use App\Models\Classes;
use App\Models\Instructor;
use App\Models\Registration;
use Carbon\Carbon;
use Closure;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class ShowClassScheduled extends Component
{
    public Registration $registration;

    public Instructor $instructor;

    public $datetime;

    public $props;

    public $rules = [
        'status' => 'required',
    ];

    #[On('event-show')]
    public function show($id, $props)
    {
        $this->props        = $props;
        $this->registration = Registration::with(['classes'])->find($id);
        $this->datetime     = Carbon::parse($this->props['datetime']);
        $this->instructor   = Instructor::with('user')->find($this->props['instructor_id']);

        $this->dispatch('show-modal', modal:'modal-show-scheduled');
    }

    public function makePresence()
    {
        $this->dispatch('show-form-register', type:'presence', onSubmit:$this::class);
    }

    public function makeAbsense()
    {
        $this->dispatch('show-form-register', type:'absense', onSubmit:$this::class);
    }

    #[On('save-class')]
    public function save($data)
    {
        Classes::create([
            'registration_id' => $this->registration->id,
            'student_id'      => $this->registration->student_id,
            'modality_id'     => $this->registration->modality_id,
            'datetime'        => $this->datetime,

            'instructor_id'            => $this->props['instructor_id'],
            'scheduled_datetime'       => $this->props['scheduled_datetime'],
            'registration_schedule_id' => $this->props['registration_schedule_id'],

            'status'    => $data['status'],
            'evolution' => $data['evolution'],
        ]);

        // $this->dispatch('refresh-calendar');
        // $this->dispatch('show-event-refresh');
    }

    public function render(): View | Closure | string
    {
        return view('livewire.calendar.show-class-scheduled');
    }
}
