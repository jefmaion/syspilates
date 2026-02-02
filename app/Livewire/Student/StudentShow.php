<?php

declare(strict_types = 1);

namespace App\Livewire\Student;

use App\Enums\ClassStatusEnum;
use App\Models\Classes;
use App\Models\Student;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class StudentShow extends Component
{
    use WithPagination;

    public Student $student;

    public function mount(Student $student): void
    {
        $this->student = $student->load('user');
    }

    #[On('upload-avatar-finished')]
    public function refresh()
    {
        $this->dispatch('$refresh');
    }

    public function render(): View
    {
        return view('livewire.student.student-show', [
            'classes' => Classes::with(['instructor.user', 'registration', 'modality'])->where('status', '<>', ClassStatusEnum::SCHEDULED)->where('student_id', $this->student->id)->paginate(10, pageName:'classes'),
        ]);
    }
}
