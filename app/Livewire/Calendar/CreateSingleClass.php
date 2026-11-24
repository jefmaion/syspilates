<?php

declare(strict_types=1);

namespace App\Livewire\Calendar;

use App\Enums\ClassStatusEnum;
use App\Enums\ClassTypesEnum;
use App\Enums\TransactionTypeEnum;
use App\Models\Classes;
use App\Models\Instructor;
use App\Models\Modality;
use App\Models\Registration;
use App\Models\Student;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;

class CreateSingleClass extends Component
{
    public ?string $datetime = null;
    public ?string $date = null;
    public ?string $time = null;
    public ?int $student_id = null;
    public ?int $modality_id = null;
    public ?int $instructor_id = null;
    public ?string $value = null;
    public ?string $comments = null;

    public function updatedStudentId($studentId): void
    {
        $this->resetValidation('student_id');
        $registration = $studentId
            ? Registration::query()->where('student_id', $studentId)->actives()->latest('start')->first()
            : null;

        $this->modality_id = $registration?->modality_id;
    }

    #[On('create-single-class')]
    public function show(string $datetime): void
    {
        $this->reset();
        $this->resetValidation();

        $parsed = Carbon::parse($datetime);
        $this->datetime = $parsed->format('Y-m-d H:i:s');
        $this->date = $parsed->format('Y-m-d');
        $this->time = $parsed->format('H:i');
        $this->dispatch('show-modal', modal: 'modal-single-class');
    }

    public function save(): void
    {
        $this->value = $this->value === null ? null : brlToUsd($this->value);

        $this->validate([
            'date' => ['required', 'date'],
            'time' => ['required', 'date_format:H:i'],
            'student_id' => ['nullable', 'integer', 'exists:tenant.students,id'],
            'modality_id' => ['required_without:student_id', 'nullable', 'integer', 'exists:tenant.modalities,id'],
            'instructor_id' => ['required', 'integer', 'exists:tenant.instructors,id'],
            'value' => ['required', 'numeric', 'gt:0'],
            'comments' => ['nullable', 'string'],
        ], [
            'value.required' => 'Informe o valor da aula avulsa.',
            'value.numeric' => 'Informe um valor válido.',
            'value.gt' => 'O valor deve ser maior que zero.',
        ]);

        $registration = null;
        if ($this->student_id) {
            $registration = Registration::query()
                ->where('student_id', $this->student_id)
                ->actives()
                ->latest('start')
                ->first();

            if (! $registration) {
                $this->addError('student_id', 'O aluno não possui matrícula ativa.');
                return;
            }
        }

        $student = $this->student_id ? Student::findOrFail($this->student_id) : null;
        $modalityId = $registration?->modality_id ?? $this->modality_id;
        $datetime = Carbon::parse($this->date.' '.$this->time);
        $value = brlToUsd($this->value);

        $class = DB::transaction(function () use ($registration, $student, $modalityId, $datetime, $value) {
            $class = Classes::create([
                'registration_id' => $registration?->id,
                'student_id' => $student?->id,
                'modality_id' => $modalityId,
                'instructor_id' => $this->instructor_id,
                'scheduled_datetime' => $datetime,
                'datetime' => $datetime,
                'status' => ClassStatusEnum::SCHEDULED,
                'type' => ClassTypesEnum::SINGLE,
                'value' => $value,
                'evolution' => $this->comments,
            ]);

            Transaction::create([
                'registration_id' => $registration?->id,
                'student_id' => $student?->id,
                'instructor_id' => $this->instructor_id,
                'date' => $datetime,
                'description' => 'Aula Avulsa - '.Modality::findOrFail($modalityId)->name,
                'origin_amount' => $value,
                'amount' => $value,
                'type' => TransactionTypeEnum::CREDIT,
                'reference_type' => 'single',
                'reference_id' => $class->id,
            ]);

            return $class;
        });

        $this->dispatch('hide-modal', modal: 'modal-single-class');
        $this->dispatch('refresh-calendar');
        $this->dispatch('show-alert', message: 'Aula avulsa cadastrada.', type: 'success');
    }

    public function render(): View
    {
        return view('livewire.calendar.create-single-class', [
            'students' => Student::with('user')->whereHas('registrations', fn ($query) => $query->actives())
                ->get()->sortBy('user.name'),
            'modalities' => Modality::orderBy('name')->get(),
            'instructors' => Instructor::with('user')->get(),
        ]);
    }
}
