<?php

declare(strict_types = 1);

namespace App\Livewire\Forms;

use App\Enums\RegistrationStatusEnum;
use App\Models\Registration;
use App\Models\RegistrationPlan;
use App\Models\RegistrationSchedules;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use Livewire\Form;

class RegistrationForm extends Form
{
    public ?Registration $registation;

    public ?int $modality_id = null;

    public ?int $student_id = null;

    public string $status = RegistrationStatusEnum::ACTIVE->value;

    public ?int $duration = null;

    public ?int $class_per_week = null;

    public ?int $deadline = null;

    public ?float $value = null;

    public ?string $start = null;

    public ?array $schedule;

    public function rules()
    {
        return [

            // registration
            'modality_id' => ['required', Rule::unique('registrations', 'modality_id')->where('student_id', $this->student_id)],
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
            'modality_id' => $this->modality_id,
            'student_id'  => $this->student_id,
            'status'      => $this->status,
        ]);

        if ($registration) {
            RegistrationPlan::create([
                'registration_id' => $registration->id,
                'duration'        => $this->duration,
                'class_per_week'  => $this->class_per_week,
                'value'           => $this->value,
                'deadline'        => $this->deadline,
                'start'           => $this->start,
                'end'             => Carbon::parse($this->start)->addDays($this->duration)->format('Y-m-d'),
                'status'          => 'active',
            ]);

            // for ($i = 0;$i <= $this->class_per_week;$i++) {
            foreach ($this->schedule as $schedule) {
                $schedule['registration_id'] = $registration->id;
                RegistrationSchedules::create($schedule);
            }
        }
    }
}
