<?php

declare(strict_types = 1);

namespace App\Livewire\Calendar;

use App\Models\ExperimentalClass;
use Closure;
use Illuminate\View\View;
use Livewire\Component;

class RegisterExperimentalClass extends Component
{
    public $listeners = ['show-register-experimental' => 'show'];

    public $class;

    public $instructor_comments;

    public $status;

    public function show($id)
    {
        $this->class = ExperimentalClass::find($id);
        $this->dispatch('show-modal', modal:'modal-register-experimental');
    }

    public function submit()
    {
        $this->class->update([
            'status'              => $this->status,
            'instructor_comments' => $this->instructor_comments,
        ]);

        $this->dispatch('hide-modal', modal:'modal-register-experimental');
    }

    public function render(): View | Closure | string
    {
        return view('livewire.calendar.register-experimental-class');
    }
}
