<?php

declare(strict_types = 1);

namespace App\Livewire\Modality;

use App\Livewire\Forms\ModalityForm;
use Illuminate\View\View;
use Livewire\Component;

class CreateModality extends Component
{
    public ModalityForm $form;

    public function mount()
    {
    }

    public function save(): void
    {
        $this->form->store();

        $this->redirect(route('modality'), navigate: true);
    }

    public function render(): View
    {
        $this->form->reset();

        return view('livewire.modality.create-modality');
    }
}
