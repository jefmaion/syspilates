<?php

declare(strict_types = 1);

namespace App\Livewire\Registration;

use App\Enums\ClassStatusEnum;
use App\Models\Classes;
use Carbon\Carbon;
use Closure;
use Illuminate\View\View;
use Livewire\Component;

class UpdateClass extends Component
{
    protected $listeners = ['edit-class' => 'show'];

    public $class;

    public $isScheduled;

    public $date;

    public $time;

    public $instructor_id;

    public $status;

    public $evolution;

    public function show($id)
    {
        $this->class = Classes::find($id);

        $this->date          = $this->class->datetime->format('Y-m-d');
        $this->time          = $this->class->datetime->format('H:i:s');
        $this->instructor_id = $this->class->instructor_id;
        $this->status        = $this->class->status;
        $this->evolution     = $this->class->evolution;

        $this->isScheduled = ($this->class->status !== ClassStatusEnum::SCHEDULED);

        $this->dispatch('show-modal', modal:'modal-update-class');
    }

    public function save()
    {
        $this->validate([
            'instructor_id' => ['required'],
            'date'          => ['required'],
            'time'          => ['required'],
        ]);

        $this->class->update([
            'instructor_id' => $this->instructor_id,
            'datetime'      => Carbon::parse($this->date . ' ' . $this->time),
        ]);

        $this->dispatch('hide-modal', modal:'modal-update-class');
        $this->dispatch('refresh-registration');
    }

    public function render(): View | Closure | string
    {
        return view('livewire.registration.update-class');
    }
}
