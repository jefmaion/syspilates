<?php

declare(strict_types = 1);

namespace App\Livewire\Calendar;

use App\Enums\ClassStatusEnum;
use App\Enums\ClassTypesEnum;
use App\Models\Classes;
use App\Models\ClassMakeup;
use App\Models\Student;
use Carbon\Carbon;
use Closure;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class CreateMakeupClass extends Component
{
    public $datetime;

    public $students;

    public $classes;

    public $makeupClasses;

    public $makeupStudentId;

    public $makeupId;

    public $makeupInstructorId;

    public $comments;

    public $_classes = [];

    #[On('create-makeup-class')]
    public function show($datetime = null)
    {
        $this->reset();
        $this->resetValidation();

        $this->datetime = Carbon::parse($datetime ?? now());

        $this->loadData();

        if ($this->students->isEmpty()) {
            return lw_alert($this, 'Não existem aulas de reposição para serem agendadas');
        }

        $this->dispatch('show-modal', modal:'modal-makeup');
    }

    public function loadData()
    {
        $this->students = Student::with(['makeup', 'user'])->whereHas('makeup', function ($q) {
            return $q->where('status', 'active')->where('expires_at', '>=', now())->orderBy('expires_at');
        })->get()->sortBy('user.name')->pluck('user.shortName', 'id');
    }

    public function listAvailableClass($studentId)
    {
        if (empty($studentId)) {
            return;
        }

        $this->loadData();

        $data = ClassMakeup::with('origin')->where('status', 'active')->where('student_id', $studentId)->where('expires_at', '>=', now())->orderBy('expires_at')->get();

        $this->makeupClasses = [];

        foreach ($data as $item) {
            $this->makeupClasses[$item->id] = $item->origin->datetime->format('d/m/Y H:i') . ' - ' . ucfirst($item->origin->datetime->translatedFormat('l')) . ' - ' . $item->origin->status->label();
        }

        // $this->makeupClasses = ClassMakeup::with('origin')->where('status', 'active')->where('student_id', $studentId)->where('expires_at', '>=', now())->orderBy('expires_at')->get();
    }

    public function saveMakeup()
    {
        $this->validate([
            'makeupStudentId'    => ['required'],
            'makeupInstructorId' => ['required'],
            'makeupId'           => ['required'],
        ]);

        $makeup = ClassMakeup::with('origin')->find($this->makeupId);

        $origin = Classes::find($makeup->origin_class_id);

        $class = Classes::create([
            'student_id'      => $makeup->student_id,
            'registration_id' => $makeup->origin->registration_id,

            'modality_id'   => $makeup->origin->modality_id,
            'instructor_id' => $this->makeupInstructorId,

            'scheduled_datetime' => $this->datetime,
            'datetime'           => $this->datetime,

            'status'            => ClassStatusEnum::SCHEDULED,
            'type'              => ClassTypesEnum::MAKEUP,
            'is_makeup'         => true,
            'original_class_id' => $makeup->origin_class_id,
            'makeup_credit_id'  => $makeup->id,
        ]);

        // 2) Consome o crédito
        $makeup->update([
            'status'        => 'used',
            'used_at'       => now(),
            'used_class_id' => $class->id,
            'comments'      => $this->comments,
        ]);

        $origin->update(['makup_class_id' => $class->id]);

        $this->dispatch('hide-modal', modal:'modal-makeup');
        $this->dispatch('refresh-calendar');
        $this->dispatch('$refresh');
    }

    public function render(): View | Closure | string
    {
        return view('livewire.calendar.create-makeup-class');
    }
}
