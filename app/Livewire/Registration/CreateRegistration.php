<?php

declare(strict_types=1);

namespace App\Livewire\Registration;

use App\Enums\RegistrationStatusEnum;
use App\Livewire\Forms\RegistrationForm;
use App\Models\Registration;
use Closure;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class CreateRegistration extends Component
{
    public RegistrationForm $form;

    public Registration $registration;

    #[On('create-registration')]
    public function create()
    {
        $this->resetValidation();
        $this->resetExcept('form');
        $this->form->start = date('Y-m-d');
        $this->dispatch('show-modal', modal: 'modal-create-registration');
    }

    #[On('renew-registration')]
    public function renew($id)
    {

        $this->registration = Registration::find($id);

        if ($this->registration->has_unpaid_transactions) {
            return lw_alert($this, 'Existem mensalidades pendentes! Finalize-as antes de renovar', 'danger');
        }

        $this->resetValidation();

        $this->form->renew = true;


        $start = $this->registration->lastClass->datetime->addDays(1);

        if ($start->isSunday()) {
            $start->addDay();
        }

        $this->registration->start = $start;

        $this->form->populate($this->registration);

        $this->dispatch('show-modal', modal: 'modal-create-registration');
    }

    #[On('store-registration')]
    public function save()
    {
        $registration = $this->form->create();

        if ($this->form->renew) {
            $this->registration->update(['status' => RegistrationStatusEnum::CLOSED]);
            $registration->update(['status' => RegistrationStatusEnum::SCHEDULED]);
        }

        $this->redirect(route('registration.show', $registration), navigate: true);
    }

    public function render(): View | Closure | string
    {
        return view('livewire.registration.create-registration');
    }
}
