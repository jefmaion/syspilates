<?php

declare(strict_types = 1);

namespace App\Livewire\Calendar;

use App\Actions\CreateMarkupClass;
use App\Enums\ClassStatusEnum;
use App\Models\Classes;
use App\Models\ClassMakeup;
use Closure;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class FormRegisterClass extends Component
{
    public $id;

    public $type;

    public $fieldsExcept = [];

    public $props;

    public $data;

    public $canMakeup = true;

    public Classes $class;
    // ----

    public $registration_id;

    public $student_id;

    public $modality_id;

    public $datetime;

    public $instructor_id;

    public $scheduled_datetime;

    public $registration_schedule_id;

    public $status;

    public $evolution;

    public $exceptOptions = [
        ClassStatusEnum::SCHEDULED,
    ];

    public $makeupConditions = [
        ClassStatusEnum::CANCELED->value,
        ClassStatusEnum::JUSTIFIED->value,
    ];

    #[On('show-form-register')]
    public function open($id = null, $type = null, $data = null)
    {
        $this->reset();
        $this->resetValidation();

        $this->class = Classes::find($id);

        if ($this->class) {
            $this->status    = $this->class->status->value;
            $this->evolution = $this->class->evolution;
        };

        $this->dispatch('show-modal', modal: 'modal-register-class');
    }

    public function submit()
    {
        $this->validate([
            'status'    => 'required',
            'evolution' => ['nullable', 'string', 'required_if:status,presence,justified'],
        ]);

        $this->class->update([
            'status'    => $this->status,
            'evolution' => $this->evolution,
        ]);

        if ($this->canMakeup) {
            CreateMarkupClass::run($this->class);
        }

        $this->dispatch('hide-modal', modal: 'modal-register-class');
        $this->dispatch('class-saved', id: $this->class->id, type: $this->class->type);
    }

    protected function makeMakeup($class, $daysToExpire = 20)
    {
        if (in_array($this->status, $this->makeupConditions)) {
            if (ClassMakeup::where('origin_class_id', $class->id)->count() > 0) {
                return;
            }

            ClassMakeup::create([
                'student_id'      => $class->student_id,
                'registration_id' => $class->registration_id,
                'origin_class_id' => $class->id,
                'reason'          => $class->status,
                'expires_at'      => now()->addDays($daysToExpire),
                'status'          => 'active',
            ]);
        }
    }

    public function render(): View | Closure | string
    {
        return view('livewire.calendar.form-register-class');
    }
}
