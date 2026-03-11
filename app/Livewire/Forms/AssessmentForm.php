<?php

namespace App\Livewire\Forms;

use App\Models\Assessments;
use Livewire\Attributes\Validate;
use Livewire\Form;

class AssessmentForm extends Form
{

    public ?Assessments $assessment;

    public $user_id;
    public $question1;
    public $evolution;
    public $question2;
    public $surgeries;
    public $viscerals_question;
    public $assessment_date;

    public function save()
    {
        if (!isset($this->assessment->id)) {
            $this->assessment_date = now();
            return Assessments::create($this->all());
        }

        return $this->assessment->update($this->all());
    }

    public function populate()
    {
        $this->question1 = $this->assessment?->question1;
        $this->question2 = $this->assessment?->question2;
        $this->evolution = $this->assessment?->evolution;
        $this->viscerals_question = $this->assessment?->viscerals_question;
        $this->surgeries = $this->assessment?->surgeries;
        $this->user_id = $this->assessment?->user_id;
    }
}
