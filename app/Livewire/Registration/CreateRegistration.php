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

    #[On('create-registration')]
    public function create()
    {
        $this->resetValidation();
        $this->dispatch('show-modal', modal:'modal-create-registration');
    }

    #[On('store-registration')]
    public function save()
    {
        $this->form->create();
        $this->dispatch('hide-modal', modal:'modal-create-registration');
        $this->dispatch('refresh-registrations');
    }

    public function render(): View | Closure | string
    {
        return view('livewire.registration.create-registration');
    }
}
