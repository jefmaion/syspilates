<?php

namespace App\Livewire\Osteopathy;

use App\Livewire\Forms\AssessmentForm;
use Closure;
use Livewire\Component;
use Illuminate\View\View;

class AssessmentCreate extends Component
{

    public AssessmentForm $form;

    public function mount()
    {
        $this->form->reset();
        $this->form->resetValidation();
    }

    public function store()
    {
        $this->form->store();
    }

    public function render(): View|Closure|string
    {
        return view('livewire.osteopathy.assessment-create');
    }
}
