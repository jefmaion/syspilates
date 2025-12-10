<?php

declare(strict_types = 1);

namespace App\Livewire\Modality;

use App\Livewire\Forms\ModalityForm;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Livewire\Component;

class CreateModality extends Component
{
    public ModalityForm $form;

    public function save(): RedirectResponse
    {
        $this->form->store();

        return $this->redirect(route('modality'), navigate: true);
    }

    public function render(): View
    {
        return view('livewire.modality.create-modality');
    }
}
