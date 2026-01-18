<?php

declare(strict_types = 1);

namespace App\Livewire\Forms;

use App\Enums\RegistrationStatusEnum;
use App\Models\Registration;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use Livewire\Form;

class RegistrationForm extends Form
{
    public ?Registration $registration;

    public ?string $modality_id = null;

    public ?string $student_id = null;

    public ?int $duration = null;

    public ?string $class_per_week = null;

    public ?string $deadline = null;

    public ?string $value = null;

    public ?string $start = null;

    public string $status = RegistrationStatusEnum::ACTIVE->value;

    public array $schedule = [];

    public function updatedClassPerWeek($value)
    {
        if ($value === null || $value === '' || ! is_numeric($value)) {
            $this->class_per_week = null;
            $this->schedule       = [];

            return;
        }

        if ($value <= 0) {
            $this->schedule = [];

            return;
        }

        $this->schedule = [];

        for ($i = 0; $i < $value; $i++) {
            $this->schedule[$i] = [
                'weekday'       => null,
                'time'          => null,
                'instructor_id' => null,
            ];
        }
    }

    public function rules()
    {
        return [

            // registration
            'modality_id' => ['required', Rule::unique('registrations', 'modality_id')->whereIn('status', ['active'])->where('student_id', $this->student_id)],
            'student_id'  => ['required'],

            // registration plan
            'duration'       => ['required', 'numeric'],
            'class_per_week' => ['required', 'numeric'],
            'value'          => ['required', 'numeric'],
            'deadline'       => ['required', 'numeric'],
            'start'          => ['required', 'date'],

            'schedule'                 => ['required', 'array', 'min:' . 2],
            'schedule.*.weekday'       => ['required'],
            'schedule.*.time'          => ['required'],
            'schedule.*.instructor_id' => ['required'],

        ];
    }

    public function create()
    {
        $this->validate();

        $this->resetValidation();

        $registration = Registration::create([
            'modality_id'    => (int) $this->modality_id,
            'student_id'     => (int) $this->student_id,
            'duration'       => (int) $this->duration,
            'class_per_week' => (int) $this->class_per_week,
            'value'          => (float) $this->value,
            'deadline'       => $this->deadline,
            'start'          => $this->start,
            'end'            => Carbon::parse($this->start)->addDays((int) $this->duration)->format('Y-m-d'),
            'status'         => 'active',
        ]);

        $registration->schedule()->createMany($this->schedule);

        return $registration;
    }

    public function update()
    {
        $this->registration->schedule()->delete();
        $this->registration->schedule()->createMany($this->schedule);

        $this->registration->plan()->update([
            'duration'       => $this->duration,
            'class_per_week' => $this->class_per_week,
            'value'          => $this->value,
            'deadline'       => $this->deadline,
            'start'          => $this->start,
            'end'            => Carbon::parse($this->start)->addDays($this->duration)->format('Y-m-d'),
        ]);
    }

    public function populate(Registration $registration)
    {
        $this->registration = $registration;

        $this->modality_id    = (string) $this->registration->modality_id;
        $this->student_id     = (string) $this->registration->student_id;
        $this->status         = (string) $this->registration->status->value;
        $this->duration       = (int) $this->registration->duration->value;
        $this->class_per_week = (string) $this->registration->class_per_week;
        $this->deadline       = (string) $this->registration->deadline;
        $this->value          = (string) $this->registration->value;
        $this->start          = (string) $this->registration->start?->format('Y-m-d');

        $this->schedule = $this->registration->schedule->toArray();
    }
}
