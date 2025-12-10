<?php

declare(strict_types = 1);

namespace App\Livewire\Modality;

use App\Livewire\Forms\ModalityForm;
use App\Models\Modality;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\Features\SupportRedirects\Redirector as SupportRedirectsRedirector;

class UpdateModality extends Component
{
    public ModalityForm $form;

    public function mount(Modality $modality): void
    {
        $this->form->populate($modality);
    }

    public function save(): SupportRedirectsRedirector
    {
        $this->form->update();

        return $this->redirect(route('modality'), navigate: true);
    }

    public function render(): View
    {
        return view('livewire.modality.update-modality');
    }
}
