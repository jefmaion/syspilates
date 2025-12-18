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

    public ?int $modality_id = null;

    public ?int $student_id = null;

    public string $status = RegistrationStatusEnum::ACTIVE->value;

    public ?int $duration = null;

    public ?int $class_per_week = null;

    public ?int $deadline = null;

    public ?float $value = null;

    public ?string $start;

    public ?array $schedule;

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

        ];
    }

    public function create()
    {
        $this->validate();

        $this->resetValidation();

        $registration = Registration::create([
            'modality_id'    => $this->modality_id,
            'student_id'     => $this->student_id,
            'duration'       => $this->duration,
            'class_per_week' => $this->class_per_week,
            'value'          => $this->value,
            'deadline'       => $this->deadline,
            'start'          => $this->start,
            'end'            => Carbon::parse($this->start)->addDays($this->duration)->format('Y-m-d'),
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

        $this->modality_id = $this->registration->modality_id;
        $this->student_id  = $this->registration->student_id;
        $this->status      = $this->registration->status->value;

        $this->duration       = $this->registration->duration;
        $this->class_per_week = $this->registration->class_per_week;
        $this->deadline       = $this->registration->deadline;
        $this->value          = $this->registration->value;
        $this->start          = $this->registration->start?->format('Y-m-d');

        $this->schedule = $this->registration->schedule->toArray();
    }
}
