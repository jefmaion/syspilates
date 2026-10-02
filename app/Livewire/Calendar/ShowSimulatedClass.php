<?php

namespace App\Livewire\Calendar;

use Closure;
use Livewire\Component;
use Illuminate\View\View;
use Livewire\Attributes\On;
use App\Models\Registration;
use Carbon\Carbon;

class ShowSimulatedClass extends Component
{
    public Registration $registration;
    public $datetime;

    #[On('show-sim-class')]
    public function opens(Registration $registration, $datetime)
    {
        $this->datetime =Carbon::parse($datetime);
        $this->registration = $registration;
        $this->registration->load(['student.user', 'schedule.instructor.user']);

        $this->dispatch('show-modal', modal: 'modal-show-simulated-class');
    }

    public function render() : View|Closure|string
    {
        return view('livewire.calendar.show-simulated-class');
    }
}
