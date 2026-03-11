<?php

namespace App\Livewire\Osteopathy;

use App\Models\Assessments;
use Closure;
use Livewire\Component;
use Illuminate\View\View;
use Livewire\WithPagination;

class ClinicalAssessmentPage extends Component
{

    use WithPagination;

    public $pages = 10;

    public function render(): View|Closure|string
    {
        return view('livewire.osteopathy.clinical-assessment-page', [
            'assessments' => Assessments::with('user')->paginate($this->pages)
        ]);
    }
}
