<?php

declare(strict_types = 1);

namespace App\Livewire\Student;

use App\Livewire\Forms\StudentForm;
use App\Livewire\Forms\UserForm;
use App\Models\Student;
use Illuminate\View\View;
use Livewire\Component;

class UpdateStudent extends Component
{
    public UserForm $user;

    public StudentForm $form;

    public Student $student;

    public function mount(Student $student): void
    {
        $this->select($student);
    }

    public function getAddress(): void
    {
        $this->user->getAddress();
    }

    public function select(?Student $student): void
    {
        $this->student = $student;

        $this->user->populate($this->student->user);
        $this->form->populate($this->student);
    }

    public function save(): void
    {
        $this->validate();

        $this->user->update();
        $this->form->update();

        $this->dispatch('student-updated');

        $this->redirect(route('student'), navigate: true);
    }

    public function render(): View
    {
        return view('livewire.student.update-student');
    }
}
