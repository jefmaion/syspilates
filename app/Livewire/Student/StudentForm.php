<?php

declare(strict_types = 1);

namespace App\Livewire\Student;

use App\Livewire\Forms\StudentForm as FormsStudentForm;
use App\Livewire\Forms\UserForm;
use App\Models\Student;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class StudentForm extends Component
{
    public UserForm $user;

    public FormsStudentForm $form;

    public ?Student $student = null;

    public bool $edit = false;

    #[On('create-student')]
    public function create(): void
    {
        $this->reset();
        $this->resetValidation();
        $this->dispatch('show-modal', modal:'modal-form-student');
    }

    #[On('edit-student')]
    public function edit(Student $student): void
    {
        $this->mount($student);
        $this->resetValidation();
        $this->dispatch('show-modal', modal:'modal-form-student');
    }

    public function mount(?Student $student): void
    {
        $this->student = $student;

        if (isset($this->student->id)) {
            $this->edit = true;
        }

        $this->form->populate($this->student);
        $this->user->populate($this->student?->user);
    }

    public function getAddress(): void
    {
        $this->user->getAddress();
    }

    public function store(): void
    {
        $this->validate();

        $user = $this->user->create();
        $this->form->create($user);
        $this->dispatch('hide-modal', modal:'modal-form-student');
        $this->dispatch('student-created');
    }

    public function update(): void
    {
        $this->validate();
        $this->user->update();
        $this->form->update();

        $this->dispatch('hide-modal', modal:'modal-form-student');
        $this->dispatch('student-updated');
    }

    public function render(): View
    {
        return view('livewire.student.student-form');
    }
}
