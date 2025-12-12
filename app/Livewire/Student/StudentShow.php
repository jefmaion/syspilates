<?php

declare(strict_types = 1);

namespace App\Livewire\Student;

use App\Models\Student;
use Illuminate\View\View;
use Livewire\Component;

class StudentShow extends Component
{
    public Student $student;

    public function mount(Student $student): void
    {
        $this->student = $student;
    }

    public function render(): View
    {
        return view('livewire.student.student-show');
    }
}
