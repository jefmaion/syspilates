<?php

declare(strict_types=1);

namespace App\Livewire\Calendar;

use App\Enums\ClassStatusEnum;
use App\Enums\ClassTypesEnum;
use App\Models\Classes;
use App\Models\ClassMakeup;
use Carbon\Carbon;
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

    public $canMakeup=true;


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

    public $makeupConditions = [
        ClassStatusEnum::CANCELED->value,
        ClassStatusEnum::JUSTIFIED->value,
    ];

    #[On('show-form-register')]
    public function open($id=null, $data = null)
    {

        $this->reset();
        $this->resetValidation();

        $this->class = Classes::find($id);

        // $this->id = $data['id'] ?? '';
        // $this->type = $data['type'] ?? '';

        // $this->registration_id = $data['registration_id'] ?? null;
        // $this->student_id = $data['student_id'] ?? null;
        // $this->modality_id = $data['modality_id'] ?? null;
        // $this->datetime = $data['datetime'] ?? null;
        // $this->instructor_id = $data['instructor_id'] ?? null;
        // $this->scheduled_datetime = $data['scheduled_datetime'] ?? null;
        // $this->registration_schedule_id = $data['registration_schedule_id'] ?? null;
        // $this->status = $data['status'] ?? null;
        // $this->evolution = $data['evolution'] ?? null;


        $this->dispatch('show-modal', modal: 'modal-register-class');
    }

    public function submit()
    {

        $this->validate([
            'status' => 'required',
            'evolution' => ['nullable', 'string', 'required_if:status,presence,justified'],
        ]);

        // if ($this->type == 'scheduled') {
        //     $class = Classes::create([
        //         'registration_id'          => $this->registration_id,
        //         'student_id'               => $this->student_id,
        //         'modality_id'              => $this->modality_id,
        //         'datetime'                 => Carbon::parse($this->datetime),
        //         'instructor_id'            => $this->instructor_id,
        //         'scheduled_datetime'       => $this->scheduled_datetime,
        //         'type' => ClassTypesEnum::REGULAR->value,
        //         'registration_schedule_id' => $this->registration_schedule_id,
        //         'status'                   => $this->status,
        //         'evolution'                => $this->evolution,
        //     ]);
        // } else {
        //     $class = Classes::find($this->id);

        //     $class->update([
        //         'status'    => $this->status,
        //         'evolution' => $this->evolution,
        //     ]);
        // }

        $this->class->update([
            'status' => $this->status,
            'evolution' => $this->evolution
        ]);

        if ($this->canMakeup) {
            $this->makeMakeup($this->class);
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
                'reason'          => $this->evolution,
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
