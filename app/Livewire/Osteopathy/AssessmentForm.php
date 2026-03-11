<?php

namespace App\Livewire\Osteopathy;

use App\Livewire\Forms\AssessmentForm as FormsAssessmentForm;
use App\Models\Assessments;
use Closure;
use Livewire\Component;
use Illuminate\View\View;
use Livewire\Attributes\On;

class AssessmentForm extends Component
{

    public FormsAssessmentForm $form;

    public function mount(?Assessments $assessment)
    {
        $this->form->assessment = $assessment;
        $this->form->populate();
    }

    public function save()
    {
        $this->form->save();
    }

    public function render(): View|Closure|string
    {
        return view('livewire.osteopathy.assessment-form');
    }
}
