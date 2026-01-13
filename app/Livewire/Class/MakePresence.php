<?php

namespace App\Livewire\Class;

use App\Models\Registration;
use App\Models\Student;
use Closure;
use Livewire\Component;
use Illuminate\View\View;
use Livewire\Attributes\On;

class MakePresence extends Component
{
    public Registration $registration;

    public string $date;

    public function mount(Registration $registration) {
        $this->registration = $registration;
    }

    #[On('make-presence')]
    public function show(string $date) {
        $this->date = $date;
        $this->dispatch('show-modal', modal:'modal-presence');
    }

    public function render() : View|Closure|string
    {
        return view('livewire.class.make-presence');
    }
}
