<?php

declare(strict_types = 1);

namespace App\Livewire\Registration;

use App\Livewire\Forms\RegistrationForm;
use Closure;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class CreateRegistration extends Component
{
    public RegistrationForm $form;

    public function mount()
    {
        // $this->form->schedule = [];
    }

    #[On('create-registration')]
    public function create()
    {
        $this->resetValidation();
        $this->resetExcept('form');
        $this->form->start = date('Y-m-d');
        $this->dispatch('show-modal', modal:'modal-create-registration');
    }

    #[On('store-registration')]
    public function save()
    {
        $registration = $this->form->create();
        $this->redirect(route('registration.show', $registration), navigate:true);
    }

    public function render(): View | Closure | string
    {
        return view('livewire.registration.create-registration');
    }
}
