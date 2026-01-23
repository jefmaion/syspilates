<?php

declare(strict_types = 1);

namespace App\Livewire\Calendar;

use App\Enums\ClassStatusEnum;
use App\Models\Classes;
use App\Models\ClassMakeup;
use Carbon\Carbon;
use Closure;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class FormRegisterClass extends Component
{
    public $status;

    public $evolution;

    public $onSubmit;

    public $rules;

    public $type;

    public $fieldsExcept = [];

    public $props;

    public $data;

    public function mount()
    {
        logger('MOUNT FormRegisterClass', ['id' => spl_object_id($this)]);
    }

    #[On('show-form-register')]
    public function open($data = null)
    {
        $this->reset();
        $this->resetValidation();

        $this->data = $data;

        if (isset($data['class']) && ! empty($data['class'])) {
            $this->status    = $data['class']['status'];
            $this->evolution = $data['class']['evolution'];
        }

        $this->dispatch('show-modal', modal:'modal-register-class');
    }

    public function submit()
    {
        // $this->dispatch('register-submited', data: $this->only(['status', 'evolution']))->to($this->onSubmit);

        if ($this->data['eventType'] == 'scheduled') {
            $class = Classes::create([
                'registration_id'          => $this->data['registration']['id'],
                'student_id'               => $this->data['registration']['student_id'],
                'modality_id'              => $this->data['registration']['modality_id'],
                'datetime'                 => Carbon::parse($this->data['eventProps']['datetime']),
                'instructor_id'            => $this->data['eventProps']['instructor_id'],
                'scheduled_datetime'       => $this->data['eventProps']['scheduled_datetime'],
                'registration_schedule_id' => $this->data['eventProps']['registration_schedule_id'],
                'status'                   => $this->status,
                'evolution'                => $this->evolution,
            ]);
        } else {
            $class = Classes::find($this->data['class']['id']);

            $class->update([
                'status'    => $this->status,
                'evolution' => $this->evolution,
            ]);
        }

        if ($this->status == ClassStatusEnum::JUSTIFIED->value || $this->status == ClassStatusEnum::CANCELED->value) {
            if (ClassMakeup::where('origin_class_id', $class->id)->count() > 0) {
                return;
            }

            ClassMakeup::create([
                'student_id'      => $class->student_id,
                'registration_id' => $class->registration_id,
                'origin_class_id' => $class->id,
                'reason'          => $this->status,
                'expires_at'      => now()->addDays(20),
                'status'          => 'active',
            ]);
        }

        $this->dispatch('hide-modal', modal:'modal-register-class');
        $this->dispatch('class-saved', id:$class->id);
    }

    public function render(): View | Closure | string
    {
        return view('livewire.calendar.form-register-class');
    }
}
