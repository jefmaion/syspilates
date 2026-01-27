<?php

declare(strict_types = 1);

namespace App\Livewire\Calendar;

use App\Models\ExperimentalClass;
use Closure;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class ShowExperimentalClass extends Component
{
    public $class;

    public $status;

    public $comments;

    #[On('show-experimental-class')]
    public function show($id)
    {
        $this->load($id);
        $this->dispatch('show-modal', modal:'modal-show-experimental');
    }

    #[On('refresh-experimental-class')]
    public function load($id)
    {
        $this->class = ExperimentalClass::with('instructor.user', 'modality')->find($id);
        // dd($this->class);
    }

    public function registerClass()
    {
        $this->dispatch('show-register-experimental', id:$this->class->id)->to(RegisterExperimentalClass::class);
    }

    public function edit()
    {
        $this->dispatch('edit-experimental-class', id:$this->class->id)->to(CreateExperimentalClass::class);
    }

    public function removeClass()
    {
        $this->dispatch('show-modal', modal:'modal-delete');
    }

    public function delete()
    {
        $this->class->delete();

        $this->dispatch('hide-modal', modal:'modal-delete');
        $this->dispatch('hide-modal', modal:'modal-show-experimental');
        $this->dispatch('refresh-calendar');
    }

    public function render(): View | Closure | string
    {
        return view('livewire.calendar.show-experimental-class');
    }
}
