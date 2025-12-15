<?php

declare(strict_types = 1);

namespace App\Livewire\Instructor;

use App\Livewire\Forms\InstructorModalityForm as FormsInstructorModalityForm;
use App\Models\Instructor;
use Closure;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class InstructorModalityForm extends Component
{
    public Instructor $instructor;

    public FormsInstructorModalityForm $form;

    public bool $edit = false;

    public string $label = 'Valor da comissão';

    public function mount(Instructor $instructor): void
    {
        $this->form->instructor = $instructor;
    }

    public function setComissionLabel(): void
    {
        $this->label = ($this->form->commission_type == 'percent') ? '% da comissão' : 'Valor da comissão';
    }

    #[On('edit-modality')]
    public function editModality(int $modalityId): void
    {
        $this->edit       = true;
        $this->form->edit = $this->edit;
        $this->form->selectModalityToEdit($modalityId);
        $this->dispatch('show-modal', modal: 'modal-form-instructor-modality');
    }

    public function update(): void
    {
        $this->form->update();
        $this->edit       = false;
        $this->form->edit = $this->edit;
        $this->dispatch('hide-modal', modal: 'modal-form-instructor-modality');
    }

    #[On('attach-modality')]
    public function addModality(): void
    {
        $this->edit       = false;
        $this->form->edit = $this->edit;
        $this->resetValidation();
        $this->form->resetFields();
        $this->dispatch('show-modal', modal: 'modal-form-instructor-modality');
    }

    public function add(): void
    {
        $this->form->add();
        $this->dispatch('hide-modal', modal: 'modal-form-instructor-modality');
        $this->dispatch('modality-attached');
    }

    #[On('remove-modality')]
    public function remove(int $modalityId): void
    {
        $this->instructor->modalities()->detach($modalityId);
        $this->dispatch('modality-removed');
    }

    public function render(): View | Closure | string
    {
        return view('livewire.instructor.instructor-modality-form');
    }
}
