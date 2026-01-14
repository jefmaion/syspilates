<?php

declare(strict_types = 1);

namespace App\Livewire\modality;

use App\Livewire\Forms\ModalityForm as FormsModalityForm;
use App\Models\Modality;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class ModalityForm extends Component
{
    public FormsModalityForm $form;

    public ?Modality $modality = null;

    public bool $edit = false;

    #[On('create-modality')]
    public function create(): void
    {
        // $this->reset();
        $this->resetValidation();
        $this->dispatch('show-modal', modal:'modal-form-modality');
    }

    #[On('edit-modality')]
    public function edit(Modality  $modality): void
    {
        $this->mount($modality);
        $this->resetValidation();
        $this->dispatch('show-modal', modal:'modal-form-modality');
    }

    public function mount(?Modality  $modality): void
    {
        $this->modality = $modality;

        if (isset($this->modality->id)) {
            $this->edit = true;
        }

        $this->form->populate($this->modality);
    }

    public function store(): void
    {
        $this->form->store();

        $this->dispatch('hide-modal', modal:'modal-form-modality');
        $this->dispatch('show-alert', message:'Modalidade cadastrada com sucesso!');
        $this->dispatch('modality-created');
    }

    public function update(): void
    {
        $this->validate();
        $this->form->update();

        $this->dispatch('hide-modal', modal:'modal-form-modality');
        $this->dispatch('show-alert', message:'Dados alterados com sucesso!');
        $this->dispatch('modality-updated');
    }

    public function render(): View
    {
        return view('livewire.modality.modality-form');
    }
}
