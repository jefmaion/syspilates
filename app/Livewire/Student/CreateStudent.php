<?php

declare(strict_types = 1);

namespace App\Livewire\Student;

use App\Livewire\Forms\StudentForm;
use App\Livewire\Forms\UserForm;
use Illuminate\View\View;
use Livewire\Component;

class CreateStudent extends Component
{
    public UserForm $user;

    public StudentForm $form;

    public function getAddress(): void
    {
        $this->user->getAddress();
    }

    public function save(): void
    {
        $this->validate();

        $user = $this->user->create();

        $this->form->create($user);

        $this->dispatch('student-created');

        $this->redirect(route('student'), navigate:true);
    }

    public function render(): View
    {
        return view('livewire.student.create-student');
    }
}
