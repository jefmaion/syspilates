<?php

declare(strict_types = 1);

namespace App\Livewire\Instructor;

use App\Livewire\Forms\InstructorForm as FormsInstructorForm;
use App\Livewire\Forms\UserForm;
use App\Models\Instructor;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class InstructorForm extends Component
{
    public UserForm $user;

    public FormsInstructorForm $form;

    public ?Instructor $instructor = null;

    public bool $edit = false;

    public bool $modal = true;

    #[On('create-instructor')]
    public function create(): void
    {
        $this->user->reset();
        $this->form->reset();

        $this->resetValidation();
        $this->dispatch('show-modal', modal:'modal-form-instructor');
    }

    #[On('edit-instructor')]
    public function edit(Instructor  $instructor): void
    {
        $this->mount($instructor);
        $this->resetValidation();
        $this->dispatch('show-modal', modal:'modal-form-instructor');
    }

    public function mount(?Instructor  $instructor): void
    {
        $this->instructor = $instructor;

        if (isset($this->instructor->id)) {
            $this->edit = true;
        }

        $this->form->populate($this->instructor);
        $this->user->populate($this->instructor?->user);
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
        $this->dispatch('hide-modal', modal:'modal-form-instructor');
        $this->dispatch('show-alert', message:'Professor cadastrado com sucesso!');
        $this->dispatch('instructor-created');
    }

    public function update(): void
    {
        $this->validate();
        $this->user->update();
        $this->form->update();

        $this->dispatch('hide-modal', modal:'modal-form-instructor');
        $this->dispatch('show-alert', message:'Dados alterados com sucesso!');
        $this->dispatch('instructor-updated');
    }

    public function render(): View
    {
        return view('livewire.instructor.instructor-form');
    }
}
